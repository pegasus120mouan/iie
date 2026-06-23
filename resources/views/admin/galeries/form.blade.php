@extends('layouts.admin')

@section('title', isset($galerie) ? 'Modifier galerie' : 'Ajouter à la galerie')

@section('content')
<div class="mb-8"><h1 class="text-3xl font-bold text-navy dark:text-white">{{ isset($galerie) ? 'Modifier' : 'Ajouter' }}</h1></div>
<form action="{{ isset($galerie) ? route('admin.galeries.update', $galerie) : route('admin.galeries.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-xl p-8 card-shadow max-w-2xl">
    @csrf @if(isset($galerie)) @method('PUT') @endif
    <div class="space-y-6">
        <div><label class="form-label">Titre *</label><input type="text" name="title" value="{{ old('title', $galerie->title ?? '') }}" class="form-input" required></div>
        <div><label class="form-label">Description</label><textarea name="description" rows="3" class="form-input">{{ old('description', $galerie->description ?? '') }}</textarea></div>
        <div><label class="form-label">Type *</label><select name="type" class="form-input"><option value="photo" {{ old('type', $galerie->type ?? '') === 'photo' ? 'selected' : '' }}>Photo</option><option value="video" {{ old('type', $galerie->type ?? '') === 'video' ? 'selected' : '' }}>Vidéo</option></select></div>
        <div><label class="form-label">Catégorie</label><input type="text" name="category" value="{{ old('category', $galerie->category ?? '') }}" class="form-input"></div>
        <div><label class="form-label">Fichier {{ isset($galerie) ? '' : '*' }}</label><input type="file" name="file" class="form-input" {{ isset($galerie) ? '' : 'required' }}></div>
        <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $galerie->is_active ?? true) ? 'checked' : '' }}> Actif</label>
    </div>
    <div class="flex gap-4 mt-8"><button type="submit" class="btn-gold">Enregistrer</button><a href="{{ route('admin.galeries.index') }}" class="btn-navy">Annuler</a></div>
</form>
@endsection
