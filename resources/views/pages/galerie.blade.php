@extends('layouts.app')

@section('title', 'Galerie')

@section('content')
<section class="page-hero pt-32 pb-20">
  <div class="container mx-auto px-4 text-center" data-aos="fade-up">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Galerie</h1>
    <p class="text-xl text-slate">Photos, vidéos et activités de l'IIE</p>
  </div>
</section>

<section class="filter-bar">
  <div class="container mx-auto px-4 flex flex-wrap justify-center gap-3">
    <a href="{{ route('galerie') }}" class="filter-pill {{ !request('type') ? 'filter-pill-active' : '' }}">Tout</a>
    <a href="{{ route('galerie', ['type' => 'photo']) }}" class="filter-pill {{ request('type') === 'photo' ? 'filter-pill-active' : '' }}"><i class="fas fa-image mr-1"></i>Photos</a>
    <a href="{{ route('galerie', ['type' => 'video']) }}" class="filter-pill {{ request('type') === 'video' ? 'filter-pill-active' : '' }}"><i class="fas fa-video mr-1"></i>Vidéos</a>
  </div>
</section>

<section class="py-16 section-alt">
  <div class="container mx-auto px-4">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($galeries as $item)
        <div class="group relative rounded-2xl overflow-hidden card-shadow aspect-video bg-navy" data-aos="fade-up">
          <div class="absolute inset-0 flex items-center justify-center">
            <i class="fas {{ $item->type === 'video' ? 'fa-play-circle' : 'fa-image' }} text-gold text-5xl group-hover:scale-110 transition-transform"></i>
          </div>
          <div class="absolute inset-0 bg-gradient-to-t from-navy/90 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-6">
            <div>
              <span class="text-gold text-xs font-semibold uppercase">{{ $item->category }}</span>
              <h3 class="text-white font-bold">{{ $item->title }}</h3>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="mt-12">{{ $galeries->withQueryString()->links() }}</div>
  </div>
</section>
@endsection
