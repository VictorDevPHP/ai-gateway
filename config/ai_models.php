<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Provedores e modelos (LLM)
    |--------------------------------------------------------------------------
    |
    | Estrutura: providers.{provedor}.{model_id_na_api} => model_id, description
    | Groq — https://console.groq.com/docs/models
    | Preview: podem ser descontinuados; não recomendados para produção (doc Groq).
    |
    | cost: preços USD (doc Groq). Para texto: input/output por 1M tokens.
    |       usd_per_audio_hour (Whisper), usd_per_million_characters (Orpheus), null se indisponível.
    |
    */

    'groq' => [

        'llama-3-1-8b-instant' => [
            'model_id' => 'llama-3.1-8b-instant',
            'description' => 'Meta Llama 3.1 8B — rápido, baixo custo (produção).',
            'cost' => [
                'input_usd_per_million' => 0.05,
                'output_usd_per_million' => 0.08,
            ],
        ],

        'llama-3-3-70b-versatile' => [
            'model_id' => 'llama-3.3-70b-versatile',
            'description' => 'Meta Llama 3.3 70B — raciocínio mais forte (produção).',
            'cost' => [
                'input_usd_per_million' => 0.59,
                'output_usd_per_million' => 0.79,
            ],
        ],

        'openai/gpt-oss-20b' => [
            'model_id' => 'openai/gpt-oss-20b',
            'description' => 'OpenAI GPT OSS 20B (produção).',
            'cost' => [
                'input_usd_per_million' => 0.075,
                'output_usd_per_million' => 0.30,
            ],
        ],

        'openai/gpt-oss-120b' => [
            'model_id' => 'openai/gpt-oss-120b',
            'description' => 'OpenAI GPT OSS 120B (produção).',
            'cost' => [
                'input_usd_per_million' => 0.15,
                'output_usd_per_million' => 0.60,
            ],
        ],

        'groq/compound' => [
            'model_id' => 'groq/compound',
            'description' => 'Groq Compound — sistema com ferramentas (produção).',
            'cost' => null,
        ],

        'groq/compound-mini' => [
            'model_id' => 'groq/compound-mini',
            'description' => 'Groq Compound Mini (produção).',
            'cost' => null,
        ],

        'whisper-large-v3' => [
            'model_id' => 'whisper-large-v3',
            'description' => 'OpenAI Whisper Large V3 — transcrição de áudio (produção).',
            'cost' => [
                'usd_per_audio_hour' => 0.111,
            ],
        ],

        'whisper-large-v3-turbo' => [
            'model_id' => 'whisper-large-v3-turbo',
            'description' => 'Whisper Large V3 Turbo — transcrição (produção).',
            'cost' => [
                'usd_per_audio_hour' => 0.04,
            ],
        ],

        'canopylabs/orpheus-arabic-saudi' => [
            'model_id' => 'canopylabs/orpheus-arabic-saudi',
            'description' => 'Canopy Labs Orpheus Arabic Saudi — TTS (preview).',
            'cost' => [
                'usd_per_million_characters' => 40.00,
            ],
        ],

        'canopylabs/orpheus-v1-english' => [
            'model_id' => 'canopylabs/orpheus-v1-english',
            'description' => 'Canopy Labs Orpheus V1 English — TTS (preview).',
            'cost' => [
                'usd_per_million_characters' => 22.00,
            ],
        ],

        'meta-llama/llama-4-scout-17b-16e-instruct' => [
            'model_id' => 'meta-llama/llama-4-scout-17b-16e-instruct',
            'description' => 'Meta Llama 4 Scout 17B 16E — instrução (preview).',
            'cost' => [
                'input_usd_per_million' => 0.11,
                'output_usd_per_million' => 0.34,
            ],
        ],

        'meta-llama/llama-prompt-guard-2-22m' => [
            'model_id' => 'meta-llama/llama-prompt-guard-2-22m',
            'description' => 'Meta Prompt Guard 2 22M — segurança de prompt (preview).',
            'cost' => [
                'input_usd_per_million' => 0.03,
                'output_usd_per_million' => 0.03,
            ],
        ],

        'meta-llama/llama-prompt-guard-2-86m' => [
            'model_id' => 'meta-llama/llama-prompt-guard-2-86m',
            'description' => 'Meta Prompt Guard 2 86M — segurança de prompt (preview).',
            'cost' => [
                'input_usd_per_million' => 0.04,
                'output_usd_per_million' => 0.04,
            ],
        ],

        'openai/gpt-oss-safeguard-20b' => [
            'model_id' => 'openai/gpt-oss-safeguard-20b',
            'description' => 'OpenAI Safety GPT OSS 20B (preview).',
            'cost' => [
                'input_usd_per_million' => 0.075,
                'output_usd_per_million' => 0.30,
            ],
        ],

        'qwen/qwen3-32b' => [
            'model_id' => 'qwen/qwen3-32b',
            'description' => 'Alibaba Cloud Qwen3 32B (preview).',
            'cost' => [
                'input_usd_per_million' => 0.29,
                'output_usd_per_million' => 0.59,
            ],
        ],
    ],

];
