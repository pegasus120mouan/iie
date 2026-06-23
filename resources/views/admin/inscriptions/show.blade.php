@extends('layouts.admin')

@section('title', 'Dossier '.$inscription->numero_dossier)

@section('content')
<div class="mb-8">
    <a href="{{ route('admin.inscriptions.index') }}" class="text-gold text-sm"><i class="fas fa-arrow-left mr-1"></i>Retour</a>
    <h1 class="text-3xl font-bold text-navy dark:text-white mt-2">Dossier {{ $inscription->numero_dossier }}</h1>
</div>

<div class="grid lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl p-8 card-shadow">
        <h3 class="text-lg font-bold mb-6">Informations personnelles</h3>
        <dl class="grid md:grid-cols-2 gap-4 text-sm">
            <div><dt class="text-gray-500">Nom complet</dt><dd class="font-semibold">{{ $inscription->full_name }}</dd></div>
            <div><dt class="text-gray-500">Date de naissance</dt><dd>{{ $inscription->date_naissance->format('d/m/Y') }}</dd></div>
            <div><dt class="text-gray-500">Sexe</dt><dd>{{ $inscription->sexe === 'M' ? 'Masculin' : 'Féminin' }}</dd></div>
            <div><dt class="text-gray-500">Téléphone</dt><dd>{{ $inscription->telephone }}</dd></div>
            <div><dt class="text-gray-500">WhatsApp</dt><dd>{{ $inscription->whatsapp ?? '-' }}</dd></div>
            <div><dt class="text-gray-500">Email</dt><dd>{{ $inscription->email }}</dd></div>
            <div class="md:col-span-2"><dt class="text-gray-500">Adresse</dt><dd>{{ $inscription->adresse }}</dd></div>
            <div><dt class="text-gray-500">Niveau d'étude</dt><dd>{{ $inscription->niveau_etude }}</dd></div>
            <div><dt class="text-gray-500">Formation</dt><dd class="font-semibold text-gold">{{ $inscription->formation->name }}</dd></div>
        </dl>
    </div>

    <div class="space-y-6">
        <form action="{{ route('admin.inscriptions.update', $inscription) }}" method="POST" class="bg-white dark:bg-gray-800 rounded-xl p-6 card-shadow">
            @csrf @method('PUT')
            <h3 class="text-lg font-bold mb-4">Gestion du dossier</h3>
            <div class="mb-4">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-input">
                    @foreach(['en_attente', 'validee', 'refusee', 'annulee'] as $s)
                        <option value="{{ $s }}" {{ $inscription->statut === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label">Notes</label>
                <textarea name="notes" rows="3" class="form-input">{{ $inscription->notes }}</textarea>
            </div>
            <button type="submit" class="btn-gold w-full">Mettre à jour</button>
        </form>
    </div>
</div>
@endsection
