@extends('layouts.app')

@section('title', 'Inscription en ligne')

@section('content')
<x-page-hero
    title="{{ $promotion?->title ?? 'Inscription en ligne' }}"
    subtitle="{{ $promotion ? 'Inscrivez-vous à cette formation promotionnelle de l\'International Institute of Excellence' : 'Complétez le formulaire ci-dessous pour rejoindre l\'International Institute of Excellence' }}"
    :breadcrumbs="[['label' => 'Accueil', 'url' => route('home')], ['label' => 'Inscription']]"
/>

<section class="page-section section-alt">
  <div class="container mx-auto px-4 max-w-3xl">
    @if($promotion ?? null)
      <div class="mb-8 text-center" data-aos="fade-up">
        <img src="{{ $promotion->image_url }}" alt="{{ $promotion->title ?? 'Formation en vue' }}" class="max-h-72 mx-auto rounded-2xl shadow-lg border border-primary/10">
      </div>
    @endif
    <form action="{{ route('inscription.store') }}" method="POST" class="form-card" data-aos="fade-up">
      @csrf
      <x-honeypot />

      <div class="mb-8 pb-6 border-b border-primary/10">
        <h2 class="content-heading-sm">Informations personnelles</h2>
        <p class="text-slate text-sm">Les champs marqués d'un * sont obligatoires.</p>
      </div>

      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <label class="form-label">Nom *</label>
          <input type="text" name="nom" value="{{ old('nom') }}" class="form-input" required>
          @error('nom')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Prénoms *</label>
          <input type="text" name="prenoms" value="{{ old('prenoms') }}" class="form-input" required>
          @error('prenoms')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Sexe *</label>
          <select name="sexe" class="form-input" required>
            <option value="">Sélectionner</option>
            <option value="M" {{ old('sexe') === 'M' ? 'selected' : '' }}>Masculin</option>
            <option value="F" {{ old('sexe') === 'F' ? 'selected' : '' }}>Féminin</option>
          </select>
          @error('sexe')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Téléphone *</label>
          <input type="tel" name="telephone" value="{{ old('telephone') }}" class="form-input" required>
          @error('telephone')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">WhatsApp</label>
          <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}" class="form-input">
        </div>
        <div class="md:col-span-2">
          <label class="form-label">Email *</label>
          <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
          @error('email')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-2">
          <label class="form-label">Adresse *</label>
          <textarea name="adresse" rows="2" class="form-input" required>{{ old('adresse') }}</textarea>
          @error('adresse')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
        </div>
      </div>

      <div class="my-8 pt-6 border-t border-primary/10">
        <h2 class="content-heading-sm">Formation</h2>
      </div>

      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <label class="form-label">Niveau d'étude *</label>
          <select name="niveau_etude" class="form-input" required>
            <option value="">Sélectionner</option>
            @foreach(['BEPC', 'BAC', 'BAC+2', 'BAC+3', 'BAC+5', 'Autre'] as $niveau)
              <option value="{{ $niveau }}" {{ old('niveau_etude') === $niveau ? 'selected' : '' }}>{{ $niveau }}</option>
            @endforeach
          </select>
          @error('niveau_etude')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Formation choisie *</label>
          @if($formationLocked)
            <input type="hidden" name="formation_id" value="{{ $selectedFormation }}">
            <input type="hidden" name="featured_popup_id" value="{{ $featuredPopupId }}">
            <select class="form-input form-input-disabled" disabled aria-disabled="true">
              @foreach($formations as $f)
                @if($f->id == $selectedFormation)
                  <option value="{{ $f->id }}" selected>{{ $f->name }}</option>
                @endif
              @endforeach
            </select>
            <p class="text-sm text-slate mt-2">
              <i class="fas fa-bullhorn text-gold mr-1"></i>Formation issue de la promotion « Formation en vue »
            </p>
          @else
            <select name="formation_id" class="form-input" required>
              <option value="">Sélectionner une formation</option>
              @foreach($formations as $f)
                <option value="{{ $f->id }}" {{ (old('formation_id', $selectedFormation) == $f->id) ? 'selected' : '' }}>{{ $f->name }}</option>
              @endforeach
            </select>
          @endif
          @error('formation_id')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
        </div>
      </div>

      <button type="submit" class="btn-gold w-full mt-10 text-lg">
        <i class="fas fa-paper-plane mr-2"></i>Soumettre mon inscription
      </button>
    </form>
  </div>
</section>
@endsection
