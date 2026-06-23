@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<x-page-hero
    title="Contactez-nous"
    subtitle="Notre équipe est à votre écoute pour répondre à toutes vos questions"
    :breadcrumbs="[['label' => 'Accueil', 'url' => route('home')], ['label' => 'Contact']]"
/>

<section class="page-section">
  <div class="container mx-auto px-4">
    <div class="grid lg:grid-cols-2 gap-12">
      <div data-aos="fade-right">
        <span class="section-label">Écrivez-nous</span>
        <h2 class="section-title mt-2">Envoyez-nous un message</h2>
        <form action="{{ route('contact.store') }}" method="POST" class="form-card mt-8 space-y-6">
          @csrf
          <x-honeypot />
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="form-label">Nom *</label>
              <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
              @error('name')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="form-label">Email *</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
              @error('email')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
            </div>
          </div>
          <div>
            <label class="form-label">Téléphone</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-input">
          </div>
          <div>
            <label class="form-label">Sujet *</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="form-input" required>
            @error('subject')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="form-label">Message *</label>
            <textarea name="message" rows="5" class="form-input" required>{{ old('message') }}</textarea>
            @error('message')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
          </div>
          <button type="submit" class="btn-gold"><i class="fas fa-paper-plane mr-2"></i>Envoyer le message</button>
        </form>
      </div>

      <div data-aos="fade-left">
        <span class="section-label">Coordonnées</span>
        <h2 class="section-title mt-2">Nos informations</h2>
        <div class="space-y-4 mt-8">
          @foreach([
            ['icon' => 'fa-map-marker-alt', 'label' => 'Adresse', 'value' => config('iie.address')],
            ['icon' => 'fa-phone', 'label' => 'Téléphone', 'value' => config('iie.phone')],
            ['icon' => 'fa-envelope', 'label' => 'Email', 'value' => config('iie.email')],
            ['icon' => 'fa-whatsapp', 'label' => 'WhatsApp', 'value' => config('iie.whatsapp')],
          ] as $info)
            <div class="info-tile">
              <div class="info-tile-icon"><i class="fas {{ $info['icon'] }}"></i></div>
              <div>
                <div class="text-sm text-slate">{{ $info['label'] }}</div>
                <div class="font-semibold text-navy mt-0.5">{{ $info['value'] }}</div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-8 rounded-2xl overflow-hidden card-shadow h-64 border border-primary/10">
          <iframe src="{{ config('iie.google_maps_embed') }}" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy" title="Localisation IIE"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
