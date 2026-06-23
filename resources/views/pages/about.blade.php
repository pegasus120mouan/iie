@extends('layouts.app')

@section('title', 'À propos')
@section('meta_description', 'Découvrez l\'historique, la vision, la mission et les valeurs de l\'International Institute of Excellence.')

@section('content')
<section class="page-hero pt-32 pb-20">
  <div class="container mx-auto px-4 text-center" data-aos="fade-up">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">À propos de l'IIE</h1>
    <p class="text-xl text-slate max-w-2xl mx-auto">L'excellence en formation professionnelle depuis plus de 15 ans</p>
  </div>
</section>

<section class="py-20 section-light">
  <div class="container mx-auto px-4">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div data-aos="fade-right">
        <span class="section-label">Notre histoire</span>
        <h2 class="section-title mt-2">Un parcours d'excellence</h2>
        <p class="text-slate leading-relaxed mb-4">
          Fondé en 2010, l'International Institute of Excellence (IIE) est né de la vision de créer un centre de formation de classe mondiale en Afrique de l'Ouest, capable de rivaliser avec les meilleures institutions internationales.
        </p>
        <p class="text-slate leading-relaxed">
          Depuis sa création, l'IIE a formé plus de 5 000 professionnels dans les domaines des TIC, de la cybersécurité, du développement logiciel et de l'intelligence artificielle, avec un taux d'insertion professionnelle de 95%.
        </p>
      </div>
      <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=800&q=80" alt="Histoire IIE" class="rounded-2xl card-shadow" data-aos="fade-left">
    </div>
  </div>
</section>

<section class="py-20 section-alt">
  <div class="container mx-auto px-4">
    <div class="grid md:grid-cols-2 gap-8">
      <div class="bg-white rounded-2xl p-8 card-shadow border border-primary/5" data-aos="fade-up">
        <div class="w-14 h-14 bg-primary-light rounded-xl flex items-center justify-center mb-6">
          <i class="fas fa-eye text-navy text-2xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-navy mb-4">Notre Vision</h3>
        <p class="text-slate">Devenir le leader africain de la formation professionnelle en technologies de l'information, reconnu internationalement pour l'excellence de ses programmes et la qualité de ses diplômés.</p>
      </div>
      <div class="bg-white rounded-2xl p-8 card-shadow border border-primary/5" data-aos="fade-up" data-aos-delay="100">
        <div class="w-14 h-14 bg-gold-soft rounded-xl flex items-center justify-center mb-6">
          <i class="fas fa-bullseye text-gold-dark text-2xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-navy mb-4">Notre Mission</h3>
        <p class="text-slate">Former des professionnels compétents et éthiques, capables d'innover et de contribuer au développement technologique de l'Afrique et du monde, grâce à une pédagogie pratique et des certifications reconnues.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-20 section-light">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16" data-aos="fade-up">
      <span class="section-label">Ce qui nous guide</span>
      <h2 class="section-title">Nos Valeurs</h2>
    </div>
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach([
        ['icon' => 'fa-star', 'title' => 'Excellence', 'desc' => 'Nous visons les plus hauts standards de qualité.'],
        ['icon' => 'fa-handshake', 'title' => 'Intégrité', 'desc' => 'Éthique et transparence dans toutes nos actions.'],
        ['icon' => 'fa-lightbulb', 'title' => 'Innovation', 'desc' => 'Programmes constamment mis à jour.'],
        ['icon' => 'fa-heart', 'title' => 'Engagement', 'desc' => 'Dévouement à la réussite de chaque étudiant.'],
      ] as $val)
        <div class="text-center p-6 bg-white rounded-2xl border border-primary/5 card-shadow" data-aos="fade-up">
          <div class="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas {{ $val['icon'] }} text-navy text-xl"></i>
          </div>
          <h4 class="font-bold text-navy mb-2">{{ $val['title'] }}</h4>
          <p class="text-slate text-sm">{{ $val['desc'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
