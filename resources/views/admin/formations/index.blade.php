@extends('layouts.admin')

@section('title', 'Formations')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">Formations</h1>
    <a href="{{ route('admin.formations.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Durée</th>
                <th>Prix</th>
                <th>Statut</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formations as $f)
                <tr>
                    <td class="font-semibold text-navy">{{ $f->name }}</td>
                    <td>{{ $f->category->name }}</td>
                    <td>{{ $f->duration }}</td>
                    <td class="text-gold font-semibold">{{ $f->formatted_price }}</td>
                    <td>
                        <span class="badge-status {{ $f->is_active ? 'badge-active' : 'badge-inactive' }}">
                            {{ $f->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="text-right space-x-3">
                        <a href="{{ route('admin.formations.edit', $f) }}" class="text-navy hover:text-gold transition"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.formations.destroy', $f) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-red-700 transition"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-primary/8">{{ $formations->links() }}</div>
</div>
@endsection
