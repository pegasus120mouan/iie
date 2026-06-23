@extends('layouts.app')

@section('title', 'Inscription en ligne')

@section('content')
<section class="page-hero pt-32 pb-16">
  <div class="container mx-auto px-4 text-center" data-aos="fade-up">
    <h1 class="text-4xl md:text-5xl font-bold mb-4">Inscription en ligne</h1>
    <p class="text-xl text-slate">Complétez le formulaire pour rejoindre l'IIE</p>
  </div>
</section>

<section class="py-16">
  <div class="container mx-auto px-4 max-w-3xl">
    <form action="{{ route('inscription.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-2xl p-8 card-shadow" data-aos="fade-up">
      @csrf

      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <label class="form-label">Nom *</label>
          <input type="text" name="nom" value="{{ old('nom') }}" class="form-input" required>
          @error('nom')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Prénoms *</label>
          <input type="text" name="prenoms" value="{{ old('prenoms') }}" class="form-input" required>
          @error('prenoms')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Date de naissance *</label>
          <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" class="form-input" required>
          @error('date_naissance')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Sexe *</label>
          <select name="sexe" class="form-input" required>
            <option value="">Sélectionner</option>
            <option value="M" {{ old('sexe') === 'M' ? 'selected' : '' }}>Masculin</option>
            <option value="F" {{ old('sexe') === 'F' ? 'selected' : '' }}>Féminin</option>
          </select>
          @error('sexe')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Téléphone *</label>
          <input type="tel" name="telephone" value="{{ old('telephone') }}" class="form-input" required>
          @error('telephone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">WhatsApp</label>
          <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}" class="form-input">
        </div>
        <div class="md:col-span-2">
          <label class="form-label">Email *</label>
          <input type="email" name="email" value="{{ old('email') }}" class="form-input" required>
          @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="md:col-span-2">
          <label class="form-label">Adresse *</label>
          <textarea name="adresse" rows="2" class="form-input" required>{{ old('adresse') }}</textarea>
          @error('adresse')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Niveau d'étude *</label>
          <select name="niveau_etude" class="form-input" required>
            <option value="">Sélectionner</option>
            @foreach(['BEPC', 'BAC', 'BAC+2', 'BAC+3', 'BAC+5', 'Autre'] as $niveau)
              <option value="{{ $niveau }}" {{ old('niveau_etude') === $niveau ? 'selected' : '' }}>{{ $niveau }}</option>
            @endforeach
          </select>
          @error('niveau_etude')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Formation choisie *</label>
          <select name="formation_id" class="form-input" required>
            <option value="">Sélectionner une formation</option>
            @foreach($formations as $f)
              <option value="{{ $f->id }}" {{ (old('formation_id', $selectedFormation) == $f->id) ? 'selected' : '' }}>{{ $f->name }}</option>
            @endforeach
          </select>
          @error('formation_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Photo d'identité *</label>
          <input type="file" name="photo" accept="image/*" class="form-input" required>
          @error('photo')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="form-label">Pièce d'identité * (PDF, JPG, PNG)</label>
          <input type="file" name="piece_identite" accept=".pdf,.jpg,.jpeg,.png" class="form-input" required>
          @error('piece_identite')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
      </div>

      <button type="submit" class="btn-gold w-full mt-8 text-lg">
        <i class="fas fa-paper-plane mr-2"></i>Soumettre mon inscription
      </button>
    </form>
  </div>
</section>
@endsection
