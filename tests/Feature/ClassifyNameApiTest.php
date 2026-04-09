<?php

namespace Tests\Feature;

use App\Ai\Agents\ClassifyPersonName;
use Tests\TestCase;

class ClassifyNameApiTest extends TestCase
{
    private function withInternalApiToken(): self
    {
        $token = config('internal_auth.bearer_token');

        return $this->withToken($token);
    }

    public function test_post_classify_name_without_bearer_returns_401(): void
    {
        $response = $this->postJson('/api/agents/classify-name', [
            'name' => 'Maria',
            'email' => 'maria@example.com',
        ]);

        $response->assertUnauthorized();
    }

    public function test_get_root_returns_development_placeholder_not_api_validation(): void
    {
        $response = $this->getJson('/');

        $response->assertOk();
        $response->assertJson([
            'message' => 'Em desenvolvimento... Aguarde... 🤖',
        ]);
    }

    public function test_post_classify_name_without_name_key_returns_422(): void
    {
        $response = $this->withInternalApiToken()->postJson('/api/agents/classify-name', []);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_post_classify_name_with_empty_string_returns_422(): void
    {
        $response = $this->withInternalApiToken()->postJson('/api/agents/classify-name', [
            'name' => '',
            'email' => 'a@b.co',
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_post_classify_name_with_valid_name_returns_200_when_agent_faked(): void
    {
        ClassifyPersonName::fake([
            [
                'score' => 85,
                'plausible' => true,
                'extracted_name' => 'Maria',
            ],
        ]);

        $response = $this->withInternalApiToken()->postJson('/api/agents/classify-name', [
            'name' => 'Maria Silva',
            'email' => 'maria@example.com',
        ]);

        $response->assertOk();
        $response->assertJsonPath('name', 'Maria Silva');
        $response->assertJsonPath('score', 85);
        $response->assertJsonPath('plausible', true);
        $response->assertJsonPath('extracted_name', 'Maria');
    }
}
