@extends('layouts.admin')

@section('title', isset($formation) ? 'Modifier formation' : 'Nouvelle formation')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-navy dark:text-white">{{ isset($formation) ? 'Modifier' : 'Nouvelle' }} formation</h1>
</div>

<form action="{{ isset($formation) ? route('admin.formations.update', $formation) : route('admin.formations.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-xl p-8 card-shadow max-w-3xl">
    @csrf
    @if(isset($formation)) @method('PUT') @endif

    <div class="grid md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <label class="form-label">Nom *</label>
            <input type="text" name="name" value="{{ old('name', $formation->name ?? '') }}" class="form-input" required>
        </div>
        <div>
            <label class="form-label">Catégorie *</label>
            <select name="category_id" class="form-input" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $formation->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="form-label">Durée *</label>
            <input type="text" name="duration" value="{{ old('duration', $formation->duration ?? '') }}" class="form-input" required>
        </div>
        <div>
            <label class="form-label">Prix (FCFA) *</label>
            <input type="number" name="price" value="{{ old('price', $formation->price ?? '') }}" class="form-input" required>
        </div>
        <div>
            <label class="form-label">Niveau requis</label>
            <input type="text" name="level_required" value="{{ old('level_required', $formation->level_required ?? '') }}" class="form-input">
        </div>
        <div>
            <label class="form-label">Certification</label>
            <input type="text" name="certification" value="{{ old('certification', $formation->certification ?? '') }}" class="form-input">
        </div>
        <div class="md:col-span-2">
            <label class="form-label">Description courte</label>
            <input type="text" name="short_description" value="{{ old('short_description', $formation->short_description ?? '') }}" class="form-input">
        </div>
        <div class="md:col-span-2">
            <label class="form-label">Description *</label>
            <textarea name="description" rows="4" class="form-input" required>{{ old('description', $formation->description ?? '') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="form-label">Débouchés</label>
            <textarea name="debouches" rows="2" class="form-input">{{ old('debouches', $formation->debouches ?? '') }}</textarea>
        </div>
        <div class="md:col-span-2">
            <label class="form-label">Programme (un module par ligne)</label>
            <textarea name="programme" rows="5" class="form-input">{{ old('programme', isset($formation) ? implode("\n", $formation->programme ?? []) : '') }}</textarea>
        </div>
        <div>
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-input" accept="image/*">
        </div>
        <div>
            <label class="form-label">Ordre</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $formation->sort_order ?? 0) }}" class="form-input">
        </div>
        <div class="flex gap-6">
            <label class="flex items-center gap-2"><input type="checkbox" name="is_popular" value="1" {{ old('is_popular', $formation->is_popular ?? false) ? 'checked' : '' }}> Populaire</label>
            <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $formation->is_active ?? true) ? 'checked' : '' }}> Actif</label>
        </div>
    </div>

    <div class="flex gap-4 mt-8">
        <button type="submit" class="btn-gold">Enregistrer</button>
        <a href="{{ route('admin.formations.index') }}" class="btn-navy">Annuler</a>
    </div>
</form>
@endsection
