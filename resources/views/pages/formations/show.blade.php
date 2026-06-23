@extends('layouts.app')

@section('title', $formation->name)

@section('content')
<x-page-hero
    :title="$formation->name"
    :subtitle="$formation->short_description"
    :badge="$formation->category->name"
    align="left"
    :breadcrumbs="[
        ['label' => 'Accueil', 'url' => route('home')],
        ['label' => 'Formations', 'url' => route('formations.index')],
        ['label' => $formation->name],
    ]"
>
    <div class="flex flex-wrap gap-6 mt-8 text-sm text-slate">
        <span class="inline-flex items-center gap-2 bg-white/80 px-4 py-2 rounded-full border border-primary/10">
            <i class="far fa-clock text-gold"></i>{{ $formation->duration }}
        </span>
        <span class="inline-flex items-center gap-2 bg-white/80 px-4 py-2 rounded-full border border-primary/10">
            <i class="fas fa-signal text-gold"></i>{{ $formation->level_required }}
        </span>
        <span class="inline-flex items-center gap-2 bg-white/80 px-4 py-2 rounded-full border border-primary/10">
            <i class="fas fa-certificate text-gold"></i>{{ $formation->certification }}
        </span>
    </div>
</x-page-hero>

<section class="page-section">
  <div class="container mx-auto px-4">
    <div class="grid lg:grid-cols-3 gap-12">
      <div class="lg:col-span-2 space-y-10">
        <div class="content-card" data-aos="fade-up">
          <h2 class="content-heading">Description</h2>
          <p class="text-slate leading-relaxed">{{ $formation->description }}</p>
        </div>

        @if($formation->programme)
          <div data-aos="fade-up">
            <h2 class="content-heading">Programme détaillé</h2>
            <div class="space-y-3 mt-6">
              @foreach($formation->programme as $module)
                <div class="module-item">
                  <div class="module-number">{{ $loop->iteration }}</div>
                  <p class="text-slate leading-relaxed">{{ $module }}</p>
                </div>
              @endforeach
            </div>
          </div>
        @endif

        @if($formation->debouches)
          <div class="content-card" data-aos="fade-up">
            <h2 class="content-heading">Débouchés</h2>
            <p class="text-slate leading-relaxed">{{ $formation->debouches }}</p>
          </div>
        @endif
      </div>

      <div>
        <div class="sidebar-card" data-aos="fade-left">
          <h3 class="content-heading-sm">Informations</h3>
          <dl class="space-y-4 text-sm mt-6">
            <div class="flex justify-between gap-4 border-b border-primary/8 pb-3"><dt>Durée</dt><dd>{{ $formation->duration }}</dd></div>
            <div class="flex justify-between gap-4 border-b border-primary/8 pb-3"><dt>Niveau requis</dt><dd>{{ $formation->level_required }}</dd></div>
            <div class="flex justify-between gap-4"><dt>Certification</dt><dd>{{ $formation->certification }}</dd></div>
          </dl>
          <a href="{{ route('inscription.create', ['formation' => $formation->id]) }}" class="btn-gold w-full text-center mt-8">
            <i class="fas fa-user-plus mr-2"></i>S'inscrire à cette formation
          </a>
        </div>
      </div>
    </div>

    @if($related->count())
      <div class="mt-20 pt-12 border-t border-primary/10">
        <span class="section-label">À découvrir aussi</span>
        <h2 class="section-title mt-2 mb-8">Formations similaires</h2>
        <div class="grid md:grid-cols-3 gap-8">
          @foreach($related as $rel)
            <a href="{{ route('formations.show', $rel->slug) }}" class="feature-card block group">
              <span class="pro-card-category">{{ $rel->category->name }}</span>
              <h4 class="font-bold text-navy mt-2 group-hover:text-gold transition">{{ $rel->name }}</h4>
              <span class="link-arrow mt-3">Voir le détail <i class="fas fa-arrow-right"></i></span>
            </a>
          @endforeach
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
