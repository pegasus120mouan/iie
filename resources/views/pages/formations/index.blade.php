@extends('layouts.app')

@section('title', 'Formations')

@section('content')
<section class="page-hero pt-32 pb-20">
  <div class="container mx-auto px-4 text-center" data-aos="fade-up">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Nos Formations</h1>
    <p class="text-xl text-slate max-w-2xl mx-auto">Des programmes professionnels conçus pour l'excellence</p>
  </div>
</section>

<section class="py-12 section-alt">
  <div class="container mx-auto px-4">
    <form method="GET" class="flex flex-col md:flex-row gap-4">
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

<section class="py-16">
  <div class="container mx-auto px-4">
    @if($formations->count())
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($formations as $formation)
          <div class="bg-white rounded-2xl overflow-hidden card-shadow group border border-primary/5" data-aos="fade-up">
            <div class="h-48 card-media relative">
              <i class="fas fa-graduation-cap text-white text-5xl group-hover:scale-110 transition-transform"></i>
              @if($formation->is_popular)
                <span class="absolute top-4 left-4 bg-gold text-white text-xs font-bold px-3 py-1 rounded-full">Populaire</span>
              @endif
            </div>
            <div class="p-6">
              <span class="text-xs text-gold font-semibold uppercase">{{ $formation->category->name }}</span>
              <h3 class="text-xl font-bold text-navy dark:text-white mt-1 mb-2">{{ $formation->name }}</h3>
              <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">{{ Str::limit($formation->short_description, 100) }}</p>
              <div class="flex items-center text-sm mb-4">
                <span class="text-gray-500"><i class="far fa-clock mr-1"></i>{{ $formation->duration }}</span>
              </div>
              <div class="flex gap-2">
                <a href="{{ route('formations.show', $formation->slug) }}" class="btn-navy flex-1 text-center text-sm !py-2">Détails</a>
                <a href="{{ route('inscription.create', ['formation' => $formation->id]) }}" class="btn-gold flex-1 text-center text-sm !py-2">S'inscrire</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="mt-12">{{ $formations->withQueryString()->links() }}</div>
    @else
      <div class="text-center py-16">
        <i class="fas fa-search text-gray-300 text-5xl mb-4"></i>
        <p class="text-gray-500 text-lg">Aucune formation trouvée.</p>
      </div>
    @endif
  </div>
</section>
@endsection
