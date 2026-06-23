@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">Utilisateurs</h1>
    <a href="{{ route('admin.users.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Nom</th><th>Email</th><th>Rôle</th><th>Actif</th><th class="text-right">Actions</th></tr></thead>
        <tbody>
            @foreach($users as $u)
                <tr>
                    <td class="font-semibold text-navy">{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role?->label ?? '-' }}</td>
                    <td><span class="badge-status {{ $u->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $u->is_active ? 'Oui' : 'Non' }}</span></td>
                    <td class="text-right space-x-3">
                        <a href="{{ route('admin.users.edit', $u) }}" class="text-navy hover:text-gold transition"><i class="fas fa-edit"></i></a>
                        @if($u->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="text-red-500"><i class="fas fa-trash"></i></button></form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $users->links() }}</div>
</div>
@endsection
