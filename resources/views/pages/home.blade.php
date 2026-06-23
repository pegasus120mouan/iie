@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
{{-- Hero Slider --}}
<section class="hero-slider relative -mt-[200px] lg:-mt-[220px]">
  @php
    $slides = [
      ['title' => 'Excellence en Formation IT', 'subtitle' => 'Formez-vous aux métiers du numérique avec des experts internationaux', 'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=1920&q=80'],
      ['title' => 'Cybersécurité & Réseaux', 'subtitle' => 'Devenez expert en protection des systèmes informatiques', 'image' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=1920&q=80'],
      ['title' => 'Data Science & IA', 'subtitle' => 'Maîtrisez l\'intelligence artificielle et l\'analyse de données', 'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=1920&q=80'],
    ];
  @endphp
  @foreach($slides as $i => $slide)
    <div class="slide hero-slide hero-slide-overlay absolute inset-0 flex items-center {{ $i === 0 ? 'active relative' : 'opacity-0' }} transition-opacity duration-1000" style="background-image: var(--iie-gradient-hero), url('{{ $slide['image'] }}')">
      <div class="container mx-auto px-4 pt-32 pb-20">
        <div class="max-w-3xl" data-aos="fade-up">
          <span class="inline-block px-4 py-1 bg-white/20 text-white rounded-full text-sm font-medium mb-4 border border-white/30 backdrop-blur-sm">International Institute of Excellence</span>
          <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight font-display">{{ $slide['title'] }}</h1>
          <p class="text-xl text-gray-200 mb-8">{{ $slide['subtitle'] }}</p>
          <div class="flex flex-wrap gap-4">
            <a href="{{ route('inscription.create') }}" class="btn-gold text-lg"><i class="fas fa-user-plus mr-2"></i>S'inscrire maintenant</a>
            <a href="{{ route('formations.index') }}" class="btn-outline-navy text-lg !border-white !text-white hover:!bg-white hover:!text-navy"><i class="fas fa-graduation-cap mr-2"></i>Nos formations</a>
          </div>
        </div>
      </div>
    </div>
  @endforeach
</section>

{{-- Présentation --}}
<section class="page-section section-light">
  <div class="container mx-auto px-4">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div data-aos="fade-right">
        <span class="section-label">Bienvenue à l'IIE</span>
        <h2 class="section-title mt-2">L'institut de référence en formation professionnelle</h2>
        <p class="text-slate leading-relaxed mb-6">
          L'International Institute of Excellence (IIE) est un centre de formation de premier plan dédié à l'excellence dans les domaines des technologies de l'information, de la cybersécurité, du développement et de l'intelligence artificielle.
        </p>
        <p class="text-slate leading-relaxed mb-8">
          Notre mission est de former des professionnels compétents, capables de répondre aux défis du marché international du travail grâce à une pédagogie innovante et des certifications reconnues.
        </p>
        <a href="{{ route('about') }}" class="btn-navy"><i class="fas fa-arrow-right mr-2"></i>En savoir plus</a>
      </div>
      <div class="relative" data-aos="fade-left">
        <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80" alt="Campus IIE" class="rounded-2xl card-shadow w-full">
        <div class="absolute -bottom-6 -left-6 stat-badge">
          <div class="stat-number">15+</div>
          <div class="text-sm text-slate">Années d'expérience</div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Chiffres clés --}}
<section class="page-section section-stats">
  <div class="container mx-auto px-4">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
      @foreach([['5000+', 'Étudiants formés', 'fa-users'], ['12+', 'Formations', 'fa-book'], ['95%', 'Taux d\'insertion', 'fa-chart-line'], ['20+', 'Partenaires', 'fa-handshake']] as $stat)
        <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <i class="fas {{ $stat[2] }} text-gold text-3xl mb-4"></i>
          <div class="stat-number">{{ $stat[0] }}</div>
          <div class="text-slate mt-2">{{ $stat[1] }}</div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Pourquoi choisir IIE --}}
<section class="page-section">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="section-label">Nos atouts</span>
      <h2 class="section-title">Pourquoi choisir l'IIE ?</h2>
      <p class="section-subtitle">Des avantages uniques pour votre réussite professionnelle</p>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach([
        ['icon' => 'fa-certificate', 'title' => 'Certifications internationales', 'desc' => 'Préparez-vous aux certifications Cisco, CompTIA, AWS et bien plus.'],
        ['icon' => 'fa-chalkboard-teacher', 'title' => 'Formateurs experts', 'desc' => 'Des professionnels en activité partagent leur expertise terrain.'],
        ['icon' => 'fa-laptop-code', 'title' => 'Équipements modernes', 'desc' => 'Laboratoires équipés des dernières technologies et logiciels.'],
        ['icon' => 'fa-briefcase', 'title' => 'Insertion professionnelle', 'desc' => 'Accompagnement personnalisé vers l\'emploi et le stage.'],
        ['icon' => 'fa-globe', 'title' => 'Standards internationaux', 'desc' => 'Programmes alignés sur les exigences du marché mondial.'],
        ['icon' => 'fa-users', 'title' => 'Réseau alumni', 'desc' => 'Rejoignez une communauté active de professionnels IT.'],
      ] as $item)
        <div class="feature-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
          <div class="icon-box">
            <i class="fas {{ $item['icon'] }}"></i>
          </div>
          <h3 class="content-heading-sm">{{ $item['title'] }}</h3>
          <p class="text-slate leading-relaxed">{{ $item['desc'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Formations populaires --}}
<section class="page-section section-alt">
  <div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-12" data-aos="fade-up">
      <div>
        <span class="section-label">Nos programmes</span>
        <h2 class="section-title">Formations populaires</h2>
      </div>
      <a href="{{ route('formations.index') }}" class="btn-outline-navy mt-4 md:mt-0">Voir toutes les formations</a>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($formations as $formation)
        <x-formation-card :formation="$formation" />
      @endforeach
    </div>
  </div>
</section>

{{-- Témoignages --}}
<section class="page-section">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="section-label">Témoignages</span>
      <h2 class="section-title">Ce que disent nos étudiants</h2>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach($temoignages as $temoignage)
        <div class="testimonial-card" data-aos="fade-up">
          <div class="flex text-gold mb-4">
            @for($i = 0; $i < $temoignage->rating; $i++)<i class="fas fa-star"></i>@endfor
          </div>
          <p class="text-slate italic mb-6">"{{ $temoignage->content }}"</p>
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-primary-light rounded-full flex items-center justify-center">
              <i class="fas fa-user text-navy"></i>
            </div>
            <div>
              <div class="font-bold text-navy">{{ $temoignage->name }}</div>
              <div class="text-sm text-slate">{{ $temoignage->formation }}</div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Actualités --}}
<section class="page-section section-light">
  <div class="container mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-12" data-aos="fade-up">
      <div>
        <span class="section-label">Restez informé</span>
        <h2 class="section-title">Actualités & Événements</h2>
      </div>
      <a href="{{ route('actualites.index') }}" class="btn-outline-navy mt-4 md:mt-0">Toutes les actualités</a>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      @foreach($actualites as $actu)
        <x-article-card :article="$actu" />
      @endforeach
    </div>
  </div>
</section>

{{-- CTA --}}
<section class="page-section section-cta relative overflow-hidden">
  <div class="absolute inset-0 opacity-10" style="background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1920&q=80'); background-size: cover;"></div>
  <div class="container mx-auto px-4 text-center relative z-10" data-aos="zoom-in">
    <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 font-display">Prêt à transformer votre avenir ?</h2>
    <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">Rejoignez l'IIE et bénéficiez d'une formation d'excellence reconnue internationalement.</p>
    <a href="{{ route('inscription.create') }}" class="btn-gold text-lg px-10 py-4">
      <i class="fas fa-user-plus mr-2"></i>S'inscrire maintenant
    </a>
  </div>
</section>
@endsection

@push('styles')
<style>
  .hero-slider { min-height: 85vh; position: relative; }
  .hero-slider .slide { transition: opacity 1s ease-in-out; }
  .hero-slider .slide.active { opacity: 1 !important; position: relative !important; }
  .hero-slider .slide:not(.active) { position: absolute; top: 0; left: 0; right: 0; }
</style>
@endpush
