@props(['formation', 'showActions' => false])

<article {{ $attributes->merge(['class' => 'pro-card group']) }} data-aos="fade-up">
    <div class="pro-card-media relative">
        <i class="fas fa-graduation-cap text-white text-5xl group-hover:scale-110 transition-transform duration-300 relative z-10"></i>
        @if($formation->is_popular)
            <span class="pro-card-badge">Populaire</span>
        @endif
        @unless($showActions)
            <span class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full border border-white/30 z-10">
                {{ $formation->category->name }}
            </span>
        @endunless
    </div>
    <div class="pro-card-body">
        @if($showActions)
            <span class="pro-card-category">{{ $formation->category->name }}</span>
        @endif
        <h3 class="pro-card-title">{{ $formation->name }}</h3>
        <p class="pro-card-excerpt">{{ Str::limit($formation->short_description, 100) }}</p>
        <div class="pro-card-meta">
            <span><i class="far fa-clock"></i>{{ $formation->duration }}</span>
        </div>
        @if($showActions)
            <div class="flex gap-2 mt-4">
                <a href="{{ route('formations.show', $formation->slug) }}" class="btn-navy flex-1 text-center text-sm !py-2.5">Détails</a>
                <a href="{{ route('inscription.create', ['formation' => $formation->id]) }}" class="btn-gold flex-1 text-center text-sm !py-2.5">S'inscrire</a>
            </div>
        @else
            <a href="{{ route('formations.show', $formation->slug) }}" class="link-arrow mt-2">
                En savoir plus <i class="fas fa-arrow-right"></i>
            </a>
        @endif
    </div>
</article>
