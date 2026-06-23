<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_security_headers_are_present(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_inscription_success_requires_signed_url(): void
    {
        $this->get('/inscription/succes/IIE-2026-00001')
            ->assertForbidden();
    }

    public function test_api_rejects_token_in_query_string(): void
    {
        config(['iie.api_token' => 'secret-token']);

        $this->getJson('/api/v1/inscriptions?api_token=secret-token')
            ->assertUnauthorized();
    }
}
