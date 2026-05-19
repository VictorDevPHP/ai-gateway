<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

#[Model('meta-llama/llama-4-scout-17b-16e-instruct')]
#[Provider(Lab::Groq)]
class ExtractorProductInformation implements Agent, Conversational, HasTools, HasStructuredOutput
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are a product information extraction expert. Analyze the provided product image and accurately extract all visible information.Do not invent or assume any data that is not clearly visible in the image.
            If the description is in English, translate it into Portuguese. Return the extracted information in a structured format, including:';
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'nome' => $schema->string()->required(),
            'categoria' => $schema->string()->required(),
            'descricao' => $schema->string()->nullable(),
            'tamanho_valor' => $schema->number()->nullable(),
            'tamanho_unidade' => $schema->string()->enum(['ml', 'l', 'L', 'g', 'kg'])->nullable(),
            'unidade_venda' => $schema->string()->enum(['lata', 'garrafa', 'unidade', 'caixa', 'pacote'])->nullable(),
        ];
    }
}
