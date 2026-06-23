@extends('layouts.app')

@section('title', 'Actualités')

@section('content')
<x-page-hero
    title="Actualités"
    subtitle="Blog, événements, séminaires et ateliers de l'IIE"
    :breadcrumbs="[['label' => 'Accueil', 'url' => route('home')], ['label' => 'Actualités']]"
/>

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

<section class="page-section section-alt">
  <div class="container mx-auto px-4">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($actualites as $actu)
        <x-article-card :article="$actu" />
      @endforeach
    </div>
    <div class="pagination-nav">{{ $actualites->withQueryString()->links() }}</div>
  </div>
</section>
@endsection
