<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Formation;
use App\Models\Inscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InscriptionApiTest extends TestCase
{
    use RefreshDatabase;

    private const API_TOKEN = 'test-api-token-secret';

    protected function setUp(): void
    {
        parent::setUp();

        config(['iie.api_token' => self::API_TOKEN]);
    }

    public function test_inscriptions_index_requires_valid_token(): void
    {
        $this->getJson('/api/v1/inscriptions')
            ->assertUnauthorized();
    }

    public function test_inscriptions_index_returns_paginated_list(): void
    {
        $formation = $this->createFormation();

        Inscription::create([
            'numero_dossier' => 'IIE-2026-00001',
            'formation_id' => $formation->id,
            'nom' => 'Kouassi',
            'prenoms' => 'Jean',
            'sexe' => 'M',
            'telephone' => '+2250700000000',
            'email' => 'jean@example.com',
            'adresse' => 'Abidjan',
            'niveau_etude' => 'BAC',
            'statut' => 'en_attente',
        ]);

        $response = $this->withToken(self::API_TOKEN)
            ->getJson('/api/v1/inscriptions');

        $response->assertOk()
            ->assertJsonPath('data.0.numero_dossier', 'IIE-2026-00001')
            ->assertJsonPath('data.0.formation.nom', $formation->name)
            ->assertJsonStructure([
                'data' => [['id', 'numero_dossier', 'nom_complet', 'formation', 'created_at']],
                'links',
                'meta',
            ]);
    }

    public function test_inscription_can_be_retrieved_by_numero(): void
    {
        $formation = $this->createFormation();

        Inscription::create([
            'numero_dossier' => 'IIE-2026-00099',
            'formation_id' => $formation->id,
            'nom' => 'Diallo',
            'prenoms' => 'Awa',
            'sexe' => 'F',
            'telephone' => '+2250700000001',
            'email' => 'awa@example.com',
            'adresse' => 'Yopougon',
            'niveau_etude' => 'BAC+2',
            'statut' => 'validee',
        ]);

        $this->withToken(self::API_TOKEN)
            ->getJson('/api/v1/inscriptions/numero/IIE-2026-00099')
            ->assertOk()
            ->assertJsonPath('data.email', 'awa@example.com')
            ->assertJsonPath('data.statut', 'validee');
    }

    private function createFormation(): Formation
    {
        $category = Category::create([
            'name' => 'Développement',
            'slug' => 'developpement',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        return Formation::create([
            'category_id' => $category->id,
            'name' => 'Développement Web',
            'slug' => 'developpement-web',
            'short_description' => 'Formation web',
            'description' => 'Description',
            'duration' => '6 mois',
            'price' => 500000,
            'is_active' => true,
        ]);
    }
}
