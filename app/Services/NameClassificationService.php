<?php

namespace App\Services;

use App\Ai\Agents\ClassifyPersonName;
use App\Services\Pricing\UsageCostCalculator;
use Illuminate\Support\Facades\Log;
use Laravel\Ai\Responses\StructuredAgentResponse;
use Throwable;
use RuntimeException;

class NameClassificationService
{
    /**
     * ID do modelo na API Groq (e chave em ai_models.groq para custo/descrição).
     */
    private $model;
    private $usageCostCalculator;

    public function __construct() {
        $this->model = config('ai_models.groq.llama-3-3-70b-versatile');
        $this->usageCostCalculator = new UsageCostCalculator();
    }

    /**
     * @return array<string, mixed>
     */
    public function classify(string $name, string $email = null): array
    {
        $prompt = $this->buildPrompt($name, $email);

        try {
            $response = (new ClassifyPersonName)->prompt($prompt, model: $this->model['model_id']);

            if (! $response instanceof StructuredAgentResponse) {
                throw new RuntimeException('Resposta do agente não está no formato estruturado esperado.');
            }

            $data = $response->toArray();

            return [
                'name' => $name,
                'score' => (int) $data['score'],
                'plausible' => (bool) $data['plausible'],
                'extracted_name' => $data['extracted_name'] ?? null,
                'usage' => [
                    'model_id' => $this->model['model_id'],
                    'cost' => $this->usageCostCalculator->calculate($this->model, $response->usage->promptTokens, $response->usage->completionTokens),
                ],
            ];
        } catch (Throwable $e) {
            Log::warning('name_classification.failed', [
                'message' => $e->getMessage(),
                'name' => $name,
            ]);

            throw $e;
        }
    }

    private function buildPrompt(string $name, ?string $email = null): string
    {
        $data = [
            'name' => $name,
            'email' => $email,
        ];

        $encoded = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);

        return <<<PROMPT
            A data a classificar (JSON-encoded) é: {$encoded}
            Aplique as regras do seu papel e preencha o schema de saída.
            Se email for fornecido use-o para identificar o nome.
            PROMPT;
    }
}
