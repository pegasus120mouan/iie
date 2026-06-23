@extends('layouts.admin')

@section('title', isset($temoignage) ? 'Modifier témoignage' : 'Nouveau témoignage')

@section('content')
<div class="mb-8"><h1 class="admin-page-title">{{ isset($temoignage) ? 'Modifier' : 'Nouveau' }} témoignage</h1></div>
<form action="{{ isset($temoignage) ? route('admin.temoignages.update', $temoignage) : route('admin.temoignages.store') }}" method="POST" enctype="multipart/form-data" class="form-card max-w-2xl">
    @csrf @if(isset($temoignage)) @method('PUT') @endif
    <div class="space-y-6">
        <div><label class="form-label">Nom *</label><input type="text" name="name" value="{{ old('name', $temoignage->name ?? '') }}" class="form-input" required></div>
        <div><label class="form-label">Formation</label><input type="text" name="formation" value="{{ old('formation', $temoignage->formation ?? '') }}" class="form-input"></div>
        <div><label class="form-label">Contenu *</label><textarea name="content" rows="4" class="form-input" required>{{ old('content', $temoignage->content ?? '') }}</textarea></div>
        <div><label class="form-label">Note (1-5)</label><input type="number" name="rating" min="1" max="5" value="{{ old('rating', $temoignage->rating ?? 5) }}" class="form-input"></div>
        <div><label class="form-label">Photo</label><input type="file" name="photo" class="form-input" accept="image/*"></div>
        <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $temoignage->is_active ?? true) ? 'checked' : '' }}> Actif</label>
    </div>
    <div class="flex gap-4 mt-8"><button type="submit" class="btn-gold">Enregistrer</button><a href="{{ route('admin.temoignages.index') }}" class="btn-navy">Annuler</a></div>
</form>
@endsection
