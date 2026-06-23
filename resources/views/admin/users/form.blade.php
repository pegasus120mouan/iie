@extends('layouts.admin')

@section('title', isset($user) ? 'Modifier utilisateur' : 'Nouvel utilisateur')

@section('content')
<div class="mb-8"><h1 class="text-3xl font-bold text-navy dark:text-white">{{ isset($user) ? 'Modifier' : 'Nouvel' }} utilisateur</h1></div>
<form action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-xl p-8 card-shadow max-w-2xl">
    @csrf @if(isset($user)) @method('PUT') @endif
    <div class="space-y-6">
        <div><label class="form-label">Nom *</label><input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" class="form-input" required></div>
        <div><label class="form-label">Email *</label><input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" class="form-input" required></div>
        <div><label class="form-label">Mot de passe {{ isset($user) ? '(laisser vide pour ne pas changer)' : '*' }}</label><input type="password" name="password" class="form-input" {{ isset($user) ? '' : 'required' }}></div>
        <div><label class="form-label">Confirmer mot de passe</label><input type="password" name="password_confirmation" class="form-input"></div>
        <div><label class="form-label">Rôle *</label><select name="role_id" class="form-input" required>@foreach($roles as $r)<option value="{{ $r->id }}" {{ old('role_id', $user->role_id ?? '') == $r->id ? 'selected' : '' }}>{{ $r->label }}</option>@endforeach</select></div>
        <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}> Actif</label>
    </div>
    <div class="flex gap-4 mt-8"><button type="submit" class="btn-gold">Enregistrer</button><a href="{{ route('admin.users.index') }}" class="btn-navy">Annuler</a></div>
</form>
@endsection
