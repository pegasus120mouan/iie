@props(['popup' => null])

@if($popup)
@php
    $inscriptionUrl = $popup->formation_id
        ? $popup->share_url
        : route('inscription.create');
@endphp
<div id="featured-popup" class="featured-popup hidden" data-popup-id="{{ $popup->id }}" role="dialog" aria-modal="true" aria-label="{{ $popup->title ?? 'Formation en vue' }}">
    <div class="featured-popup-backdrop" data-close-popup></div>
    <div class="featured-popup-panel">
        <button type="button" class="featured-popup-close" data-close-popup aria-label="Fermer">
            <i class="fas fa-times"></i>
        </button>
        @if($popup->title)
            <p class="featured-popup-title">{{ $popup->title }}</p>
        @endif
        <img src="{{ $popup->image_url }}" alt="{{ $popup->title ?? 'Formation en vue' }}" class="featured-popup-image">
        <div class="featured-popup-actions">
            <a href="{{ $inscriptionUrl }}" class="btn-gold featured-popup-btn" data-close-popup>
                <i class="fas fa-user-plus mr-2"></i>S'inscrire
            </a>
            @if($popup->click_url)
                <a href="{{ $popup->click_url }}" class="featured-popup-link" data-close-popup>
                    En savoir plus sur la formation <i class="fas fa-arrow-right ml-1"></i>
                </a>
            @endif
        </div>
    </div>
</div>
@endif
