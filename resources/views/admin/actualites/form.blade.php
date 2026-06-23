@extends('layouts.admin')

@section('title', isset($actualite) ? 'Modifier actualité' : 'Nouvelle actualité')

@section('content')
<div class="mb-8"><h1 class="admin-page-title">{{ isset($actualite) ? 'Modifier' : 'Nouvelle' }} actualité</h1></div>

<form action="{{ isset($actualite) ? route('admin.actualites.update', $actualite) : route('admin.actualites.store') }}" method="POST" enctype="multipart/form-data" class="form-card max-w-3xl">
    @csrf @if(isset($actualite)) @method('PUT') @endif
    <div class="space-y-6">
        <div><label class="form-label">Titre *</label><input type="text" name="title" value="{{ old('title', $actualite->title ?? '') }}" class="form-input" required></div>
        <div><label class="form-label">Type *</label>
            <select name="type" class="form-input" required>
                @foreach(['blog','evenement','seminaire','atelier','concours'] as $t)
                    <option value="{{ $t }}" {{ old('type', $actualite->type ?? '') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                @endforeach
            </select>
        </div>
        <div><label class="form-label">Extrait</label><input type="text" name="excerpt" value="{{ old('excerpt', $actualite->excerpt ?? '') }}" class="form-input"></div>
        <div><label class="form-label">Contenu *</label><textarea name="content" rows="8" class="form-input" required>{{ old('content', $actualite->content ?? '') }}</textarea></div>
        <div class="grid md:grid-cols-2 gap-6">
            <div><label class="form-label">Date événement</label><input type="date" name="event_date" value="{{ old('event_date', isset($actualite) && $actualite->event_date ? $actualite->event_date->format('Y-m-d') : '') }}" class="form-input"></div>
            <div><label class="form-label">Lieu</label><input type="text" name="location" value="{{ old('location', $actualite->location ?? '') }}" class="form-input"></div>
        </div>
        <div><label class="form-label">Image</label><input type="file" name="image" class="form-input" accept="image/*"></div>
        <div class="flex gap-6">
            <label class="flex items-center gap-2"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $actualite->is_published ?? true) ? 'checked' : '' }}> Publié</label>
            <label class="flex items-center gap-2"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $actualite->is_featured ?? false) ? 'checked' : '' }}> À la une</label>
        </div>
    </div>
    <div class="flex gap-4 mt-8">
        <button type="submit" class="btn-gold">Enregistrer</button>
        <a href="{{ route('admin.actualites.index') }}" class="btn-navy">Annuler</a>
    </div>
</form>
@endsection
