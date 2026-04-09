<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class ClassifyPersonName implements Agent, Conversational, HasStructuredOutput
{
    use Promptable;

    /**
     * @return Stringable|string
     */
    public function instructions(): Stringable|string
    {
        return <<<'TXT'
            Você classifica se uma string pode ser o nome de uma pessoa (nome próprio ou combinação plausível de nomes)..
            - score: inteiro de 0 a 100 (0 = claramente não é nome de pessoa, 100 = muito plausível).
            - Tente considerar apelidos como Ale, Pati, Carlinhos e etc. Se for o caso, considere aumentar o score.
            - Se conseguiu extrair um nome considere aumentar o score.
            - Se o nome for muito pequeno, pouca proporção de letras, considere reduzir o score.
            - Nomes podem estar no diminutivo e junto com números e caracteres especiais para esses casos tente identificar o nome dentro dessa string.
            - Se email for fornecido use-o para identificar o nome.
            - plausible: true se score >= 60, senão false (ajuste o limiar se o contexto exigir consistência com o score).
            - extracted_name: o melhor candidato a nome limpo (sem lixo óbvio), ou null se não houver nome utilizável.
        TXT;
    }

    /**
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * @param JsonSchema $schema
     * @return array<string, mixed>
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'score' => $schema->integer()->min(0)->max(100)->required(),
            'plausible' => $schema->boolean()->required(),
            'extracted_name' => $schema->string()->nullable()->required(),
        ];
    }
}
