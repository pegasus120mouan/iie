@extends('layouts.app')

@section('title', $actualite->title)

@section('content')
<section class="page-hero pt-32 pb-16">
  <div class="container mx-auto px-4 max-w-4xl" data-aos="fade-up">
    <span class="text-gold text-sm font-semibold uppercase">{{ $actualite->type_label }}</span>
    <h1 class="text-3xl md:text-4xl font-bold mt-2 mb-4">{{ $actualite->title }}</h1>
    <div class="flex gap-4 text-sm text-slate">
      <span><i class="far fa-calendar mr-1"></i>{{ $actualite->created_at->format('d F Y') }}</span>
      @if($actualite->event_date)
        <span><i class="far fa-clock mr-1"></i>{{ $actualite->event_date->format('d/m/Y') }}</span>
      @endif
      @if($actualite->location)
        <span><i class="fas fa-map-marker-alt mr-1"></i>{{ $actualite->location }}</span>
      @endif
    </div>
  </div>
</section>

<section class="py-16">
  <div class="container mx-auto px-4 max-w-4xl">
    <div class="prose dark:prose-invert max-w-none" data-aos="fade-up">
      {!! $actualite->content !!}
    </div>

    @if($related->count())
      <div class="mt-16 border-t pt-12">
        <h3 class="text-2xl font-bold text-navy dark:text-white mb-8">Articles similaires</h3>
        <div class="grid md:grid-cols-3 gap-6">
          @foreach($related as $rel)
            <a href="{{ route('actualites.show', $rel->slug) }}" class="bg-light dark:bg-gray-800 rounded-xl p-4 hover:shadow-lg transition">
              <span class="text-xs text-gold">{{ $rel->type_label }}</span>
              <h4 class="font-bold mt-1">{{ $rel->title }}</h4>
            </a>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
