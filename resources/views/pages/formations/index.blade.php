@extends('layouts.app')

@section('title', 'Formations')

@section('content')
<x-page-hero
    title="Nos Formations"
    subtitle="Des programmes professionnels conçus pour l'excellence et alignés sur les standards internationaux"
    :breadcrumbs="[['label' => 'Accueil', 'url' => route('home')], ['label' => 'Formations']]"
/>

<section class="search-panel">
  <div class="container mx-auto px-4">
    <form method="GET" class="flex flex-col md:flex-row gap-4 max-w-4xl mx-auto">
      <div class="flex-1">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une formation..." class="form-input">
      </div>
      <select name="category" class="form-input md:w-64">
        <option value="">Toutes les catégories</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>{{ $cat->name }} ({{ $cat->formations_count }})</option>
        @endforeach
      </select>
      <button type="submit" class="btn-gold"><i class="fas fa-search mr-2"></i>Rechercher</button>
    </form>
  </div>
</section>

<section class="page-section">
  <div class="container mx-auto px-4">
    @if($formations->count())
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($formations as $formation)
          <x-formation-card :formation="$formation" :show-actions="true" />
        @endforeach
      </div>
      <div class="pagination-nav">{{ $formations->withQueryString()->links() }}</div>
    @else
      <div class="empty-state">
        <div class="empty-state-icon"><i class="fas fa-search"></i></div>
        <p class="text-slate text-lg font-medium">Aucune formation trouvée.</p>
        <p class="text-slate text-sm mt-2">Essayez d'autres critères de recherche.</p>
        <a href="{{ route('formations.index') }}" class="btn-outline-navy mt-6">Voir toutes les formations</a>
      </div>
    @endif
  </div>
</section>
@endsection
