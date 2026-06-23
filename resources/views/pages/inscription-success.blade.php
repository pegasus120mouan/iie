@extends('layouts.app')

@section('title', 'Inscription confirmée')

@section('content')
<section class="page-section min-h-[70vh] flex items-center">
  <div class="container mx-auto px-4 max-w-2xl" data-aos="zoom-in">
    <div class="success-card">
      <div class="success-icon">
        <i class="fas fa-check text-green-600 text-4xl"></i>
      </div>
      <h1 class="text-3xl font-bold text-navy mb-4 font-display">Inscription réussie !</h1>
      <p class="text-slate mb-8 leading-relaxed">Votre demande d'inscription a été enregistrée avec succès. Un email de confirmation a été envoyé à <strong class="text-navy">{{ $inscription->email }}</strong>.</p>

      <div class="content-card text-left mb-8">
        <h3 class="content-heading-sm">Récapitulatif</h3>
        <dl class="space-y-3 text-sm mt-4">
          <div class="flex justify-between gap-4 border-b border-primary/8 pb-3">
            <dt class="text-slate">N° de dossier</dt>
            <dd class="font-bold text-gradient-gold">{{ $inscription->numero_dossier }}</dd>
          </div>
          <div class="flex justify-between gap-4 border-b border-primary/8 pb-3">
            <dt class="text-slate">Nom complet</dt>
            <dd class="font-semibold text-navy">{{ $inscription->full_name }}</dd>
          </div>
          <div class="flex justify-between gap-4 border-b border-primary/8 pb-3">
            <dt class="text-slate">Formation</dt>
            <dd class="font-semibold text-navy">{{ $inscription->formation->name }}</dd>
          </div>
          <div class="flex justify-between gap-4">
            <dt class="text-slate">Statut</dt>
            <dd><span class="badge-status badge-pending">En attente de validation</span></dd>
          </div>
        </dl>
      </div>

      <p class="text-sm text-slate mb-8">Conservez votre numéro de dossier. Notre équipe vous contactera sous 48h pour finaliser votre inscription.</p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <a href="{{ route('home') }}" class="btn-navy">Retour à l'accueil</a>
        <a href="{{ route('formations.index') }}" class="btn-outline-gold">Voir les formations</a>
      </div>
    </div>
  </div>
</section>
@endsection
