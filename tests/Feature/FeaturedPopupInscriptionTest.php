<?php

namespace Tests\Feature;

use App\Models\FeaturedPopup;
use App\Models\Formation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FeaturedPopupInscriptionTest extends TestCase
{
    use RefreshDatabase;

    public function test_share_link_shows_locked_inscription_form(): void
    {
        Storage::fake('public');
        $formation = Formation::promotion();

        $popup = FeaturedPopup::create([
            'title' => 'Formation Cybersécurité',
            'slug' => 'formation-cybersecurite',
            'formation_id' => $formation->id,
            'image' => 'featured-popups/test.jpg',
            'is_active' => false,
        ]);

        $this->get(route('formation-en-vue.inscription', $popup->slug))
            ->assertOk()
            ->assertSee('Promotion', false)
            ->assertSee('Formation issue de la promotion', false)
            ->assertSee('name="featured_popup_id" value="'.$popup->id.'"', false);
    }

    public function test_share_link_returns_404_without_formation(): void
    {
        Storage::fake('public');

        $popup = new FeaturedPopup([
            'title' => 'Sans formation',
            'slug' => 'sans-formation',
            'formation_id' => null,
            'image' => 'featured-popups/test.jpg',
            'is_active' => false,
        ]);
        $popup->save();

        $this->get(route('formation-en-vue.inscription', $popup->slug))
            ->assertNotFound();
    }
}
