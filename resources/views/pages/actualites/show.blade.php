@extends('layouts.app')

@section('title', $actualite->title)

@section('content')
<x-page-hero
    :title="$actualite->title"
    :badge="$actualite->type_label"
    align="left"
    :breadcrumbs="[
        ['label' => 'Accueil', 'url' => route('home')],
        ['label' => 'Actualités', 'url' => route('actualites.index')],
        ['label' => Str::limit($actualite->title, 40)],
    ]"
>
    <div class="flex flex-wrap gap-4 text-sm text-slate mt-4">
        <span><i class="far fa-calendar text-gold mr-1"></i>{{ $actualite->created_at->format('d F Y') }}</span>
        @if($actualite->event_date)
            <span><i class="far fa-clock text-gold mr-1"></i>{{ $actualite->event_date->format('d/m/Y') }}</span>
        @endif
        @if($actualite->location)
            <span><i class="fas fa-map-marker-alt text-gold mr-1"></i>{{ $actualite->location }}</span>
        @endif
    </div>
</x-page-hero>

<section class="page-section">
  <div class="container mx-auto px-4 max-w-4xl">
    <article class="content-card prose-content" data-aos="fade-up">
      {!! $actualite->content !!}
    </article>

    @if($related->count())
      <div class="mt-16 pt-12 border-t border-primary/10">
        <span class="section-label">À lire aussi</span>
        <h3 class="section-title mt-2 mb-8">Articles similaires</h3>
        <div class="grid md:grid-cols-3 gap-6">
          @foreach($related as $rel)
            <a href="{{ route('actualites.show', $rel->slug) }}" class="feature-card block group">
              <span class="pro-card-category">{{ $rel->type_label }}</span>
              <h4 class="font-bold text-navy mt-2 leading-snug group-hover:text-gold transition">{{ $rel->title }}</h4>
              <span class="link-arrow mt-3">Lire l'article <i class="fas fa-arrow-right"></i></span>
            </a>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
