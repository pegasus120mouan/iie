@props(['article', 'routeName' => 'actualites.show'])

<article {{ $attributes->merge(['class' => 'pro-card']) }} data-aos="fade-up">
    <div class="pro-card-media pro-card-media-sm">
        <i class="fas fa-newspaper text-white text-4xl"></i>
    </div>
    <div class="pro-card-body">
        <div class="flex justify-between items-center gap-2 mb-2">
            <span class="pro-card-category">{{ $article->type_label }}</span>
            <time class="text-xs text-slate">{{ $article->created_at->format('d/m/Y') }}</time>
        </div>
        <h3 class="pro-card-title text-lg">{{ $article->title }}</h3>
        <p class="pro-card-excerpt">{{ $article->excerpt }}</p>
        <a href="{{ route($routeName, $article->slug) }}" class="link-arrow">Lire la suite <i class="fas fa-arrow-right"></i></a>
    </div>
</article>
