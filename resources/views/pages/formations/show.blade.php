@extends('layouts.app')

@section('title', $formation->name)

@section('content')
<section class="page-hero pt-32 pb-16">
  <div class="container mx-auto px-4">
    <div class="max-w-4xl" data-aos="fade-up">
      <span class="text-gold text-sm font-semibold uppercase">{{ $formation->category->name }}</span>
      <h1 class="text-4xl md:text-5xl font-bold mt-2 mb-4">{{ $formation->name }}</h1>
      <p class="text-xl text-slate">{{ $formation->short_description }}</p>
      <div class="flex flex-wrap gap-6 mt-8 text-sm">
        <span><i class="far fa-clock text-gold mr-2"></i>{{ $formation->duration }}</span>
        <span><i class="fas fa-signal text-gold mr-2"></i>{{ $formation->level_required }}</span>
        <span><i class="fas fa-certificate text-gold mr-2"></i>{{ $formation->certification }}</span>
      </div>
    </div>
  </div>
</section>

<section class="py-16">
  <div class="container mx-auto px-4">
    <div class="grid lg:grid-cols-3 gap-12">
      <div class="lg:col-span-2 space-y-10">
        <div data-aos="fade-up">
          <h2 class="text-2xl font-bold text-navy dark:text-white mb-4">Description</h2>
          <p class="text-gray-600 dark:text-gray-300 leading-relaxed">{{ $formation->description }}</p>
        </div>

        @if($formation->programme)
          <div data-aos="fade-up">
            <h2 class="text-2xl font-bold text-navy dark:text-white mb-4">Programme détaillé</h2>
            <div class="space-y-3">
              @foreach($formation->programme as $module)
                <div class="flex items-start gap-4 bg-light dark:bg-gray-800 rounded-xl p-4">
                  <div class="w-8 h-8 bg-gold rounded-full flex items-center justify-center flex-shrink-0 text-navy font-bold text-sm">{{ $loop->iteration }}</div>
                  <p class="text-gray-700 dark:text-gray-300">{{ $module }}</p>
                </div>
              @endforeach
            </div>
          </div>
        @endif

        @if($formation->debouches)
          <div data-aos="fade-up">
            <h2 class="text-2xl font-bold text-navy dark:text-white mb-4">Débouchés</h2>
            <p class="text-gray-600 dark:text-gray-300">{{ $formation->debouches }}</p>
          </div>
        @endif
      </div>

      <div class="space-y-6">
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 card-shadow sticky top-28" data-aos="fade-left">
          <h3 class="text-xl font-bold text-navy dark:text-white mb-6">Informations</h3>
          <dl class="space-y-4 text-sm">
            <div class="flex justify-between"><dt class="text-gray-500">Durée</dt><dd class="font-semibold">{{ $formation->duration }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Niveau requis</dt><dd class="font-semibold">{{ $formation->level_required }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Certification</dt><dd class="font-semibold">{{ $formation->certification }}</dd></div>
          </dl>
          <a href="{{ route('inscription.create', ['formation' => $formation->id]) }}" class="btn-gold w-full text-center mt-6">
            <i class="fas fa-user-plus mr-2"></i>S'inscrire à cette formation
          </a>
        </div>
      </div>
    </div>

    @if($related->count())
      <div class="mt-20">
        <h2 class="section-title mb-8">Formations similaires</h2>
        <div class="grid md:grid-cols-3 gap-8">
          @foreach($related as $rel)
            <a href="{{ route('formations.show', $rel->slug) }}" class="bg-white dark:bg-gray-800 rounded-xl p-6 card-shadow hover:-translate-y-1 transition-all">
              <h4 class="font-bold text-navy dark:text-white">{{ $rel->name }}</h4>
            </a>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
