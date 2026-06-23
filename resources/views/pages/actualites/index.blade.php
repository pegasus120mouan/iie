@extends('layouts.app')

@section('title', 'Actualités')

@section('content')
<section class="page-hero pt-32 pb-20">
  <div class="container mx-auto px-4 text-center" data-aos="fade-up">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Actualités</h1>
    <p class="text-xl text-slate">Blog, événements, séminaires et plus</p>
  </div>
</section>

<section class="filter-bar">
  <div class="container mx-auto px-4">
    <div class="flex flex-wrap gap-3 justify-center">
      <a href="{{ route('actualites.index') }}" class="filter-pill {{ !request('type') ? 'filter-pill-active' : '' }}">Tous</a>
      @foreach(['blog' => 'Blog', 'evenement' => 'Événements', 'seminaire' => 'Séminaires', 'atelier' => 'Ateliers', 'concours' => 'Concours'] as $key => $label)
        <a href="{{ route('actualites.index', ['type' => $key]) }}" class="filter-pill {{ request('type') === $key ? 'filter-pill-active' : '' }}">{{ $label }}</a>
      @endforeach
    </div>
  </div>
</section>

<section class="py-16 section-alt">
  <div class="container mx-auto px-4">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($actualites as $actu)
        <article class="bg-white rounded-2xl overflow-hidden card-shadow border border-primary/5" data-aos="fade-up">
          <div class="h-48 card-media">
            <i class="fas fa-newspaper text-white text-4xl"></i>
          </div>
          <div class="p-6">
            <div class="flex justify-between items-center mb-3">
              <span class="text-xs font-semibold text-gold uppercase">{{ $actu->type_label }}</span>
              <span class="text-xs text-slate">{{ $actu->created_at->format('d/m/Y') }}</span>
            </div>
            <h3 class="text-lg font-bold text-navy mb-3">{{ $actu->title }}</h3>
            <p class="text-slate text-sm mb-4">{{ $actu->excerpt }}</p>
            <a href="{{ route('actualites.show', $actu->slug) }}" class="text-navy font-semibold hover:text-gold transition">Lire la suite →</a>
          </div>
        </article>
      @endforeach
    </div>
    <div class="mt-12">{{ $actualites->withQueryString()->links() }}</div>
  </div>
</section>
@endsection
