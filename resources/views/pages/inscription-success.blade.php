@extends('layouts.app')

@section('title', 'Inscription confirmée')

@section('content')
<section class="pt-32 pb-20 min-h-screen flex items-center">
  <div class="container mx-auto px-4 max-w-2xl text-center" data-aos="zoom-in">
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-12 card-shadow">
      <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
        <i class="fas fa-check text-green-500 text-4xl"></i>
      </div>
      <h1 class="text-3xl font-bold text-navy dark:text-white mb-4">Inscription réussie !</h1>
      <p class="text-gray-600 dark:text-gray-300 mb-6">Votre demande d'inscription a été enregistrée avec succès. Un email de confirmation a été envoyé à <strong>{{ $inscription->email }}</strong>.</p>

      <div class="bg-light dark:bg-gray-700 rounded-xl p-6 mb-8 text-left">
        <h3 class="font-bold text-navy dark:text-white mb-4">Récapitulatif</h3>
        <dl class="space-y-2 text-sm">
          <div class="flex justify-between"><dt class="text-gray-500">N° de dossier</dt><dd class="font-bold text-gold">{{ $inscription->numero_dossier }}</dd></div>
          <div class="flex justify-between"><dt class="text-gray-500">Nom complet</dt><dd>{{ $inscription->full_name }}</dd></div>
          <div class="flex justify-between"><dt class="text-gray-500">Formation</dt><dd>{{ $inscription->formation->name }}</dd></div>
          <div class="flex justify-between"><dt class="text-gray-500">Statut</dt><dd class="text-yellow-600 font-semibold">En attente de validation</dd></div>
        </dl>
      </div>

      <p class="text-sm text-gray-500 mb-8">Conservez votre numéro de dossier. Notre équipe vous contactera sous 48h pour finaliser votre inscription.</p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('home') }}" class="btn-navy">Retour à l'accueil</a>
        <a href="{{ route('formations.index') }}" class="btn-outline-gold">Voir les formations</a>
      </div>
    </div>
  </div>
</section>
@endsection
