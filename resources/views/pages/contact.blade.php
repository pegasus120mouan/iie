@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<section class="page-hero pt-32 pb-20">
  <div class="container mx-auto px-4 text-center" data-aos="fade-up">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Contactez-nous</h1>
    <p class="text-xl text-slate">Nous sommes à votre écoute</p>
  </div>
</section>

<section class="py-16">
  <div class="container mx-auto px-4">
    <div class="grid lg:grid-cols-2 gap-12">
      <div data-aos="fade-right">
        <h2 class="section-title">Envoyez-nous un message</h2>
        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6 mt-8">
          @csrf
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <label class="form-label">Nom *</label>
              <input type="text" name="name" value="{{ old('name') }}" class="form-input" required>
              @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="form-label">Email *</label>
              <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
              @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
          </div>
          <div>
            <label class="form-label">Téléphone</label>
            <input type="tel" name="phone" value="{{ old('phone') }}" class="form-input">
          </div>
          <div>
            <label class="form-label">Sujet *</label>
            <input type="text" name="subject" value="{{ old('subject') }}" class="form-input" required>
            @error('subject')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
          </div>
          <div>
            <label class="form-label">Message *</label>
            <textarea name="message" rows="5" class="form-input" required>{{ old('message') }}</textarea>
            @error('message')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
          </div>
          <button type="submit" class="btn-gold"><i class="fas fa-paper-plane mr-2"></i>Envoyer</button>
        </form>
      </div>

      <div data-aos="fade-left">
        <h2 class="section-title">Nos coordonnées</h2>
        <div class="space-y-6 mt-8">
          @foreach([
            ['icon' => 'fa-map-marker-alt', 'label' => 'Adresse', 'value' => config('iie.address')],
            ['icon' => 'fa-phone', 'label' => 'Téléphone', 'value' => config('iie.phone')],
            ['icon' => 'fa-envelope', 'label' => 'Email', 'value' => config('iie.email')],
            ['icon' => 'fa-whatsapp', 'label' => 'WhatsApp', 'value' => config('iie.whatsapp')],
          ] as $info)
            <div class="flex items-start gap-4 bg-light dark:bg-gray-800 rounded-xl p-5">
              <div class="w-12 h-12 bg-gold/10 rounded-lg flex items-center justify-center flex-shrink-0">
                <i class="fas {{ $info['icon'] }} text-gold"></i>
              </div>
              <div>
                <div class="text-sm text-gray-500">{{ $info['label'] }}</div>
                <div class="font-semibold text-navy dark:text-white">{{ $info['value'] }}</div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-8 rounded-2xl overflow-hidden card-shadow h-64">
          <iframe src="{{ config('iie.google_maps_embed') }}" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
