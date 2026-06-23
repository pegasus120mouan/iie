@extends('layouts.admin')

@section('title', 'Actualités')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">Actualités</h1>
    <a href="{{ route('admin.actualites.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Date</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actualites as $a)
                <tr>
                    <td class="font-semibold text-navy">{{ $a->title }}</td>
                    <td>{{ $a->type_label }}</td>
                    <td>
                        <span class="badge-status {{ $a->is_published ? 'badge-active' : 'badge-pending' }}">
                            {{ $a->is_published ? 'Publié' : 'Brouillon' }}
                        </span>
                    </td>
                    <td class="text-slate">{{ $a->created_at->format('d/m/Y') }}</td>
                    <td class="text-right space-x-3">
                        <a href="{{ route('admin.actualites.edit', $a) }}" class="text-navy hover:text-gold transition"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.actualites.destroy', $a) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-red-700 transition"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-primary/8">{{ $actualites->links() }}</div>
</div>
@endsection
