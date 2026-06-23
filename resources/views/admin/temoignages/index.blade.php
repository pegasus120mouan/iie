@extends('layouts.admin')

@section('title', 'Témoignages')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">Témoignages</h1>
    <a href="{{ route('admin.temoignages.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Nom</th><th>Formation</th><th>Note</th><th>Actif</th><th class="text-right">Actions</th></tr></thead>
        <tbody>
            @foreach($temoignages as $t)
                <tr>
                    <td class="font-semibold text-navy">{{ $t->name }}</td>
                    <td>{{ $t->formation }}</td>
                    <td class="text-gold">@for($i=0;$i<$t->rating;$i++)<i class="fas fa-star text-xs"></i>@endfor</td>
                    <td><span class="badge-status {{ $t->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $t->is_active ? 'Oui' : 'Non' }}</span></td>
                    <td class="text-right space-x-3">
                        <a href="{{ route('admin.temoignages.edit', $t) }}" class="text-navy hover:text-gold transition"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.temoignages.destroy', $t) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="text-red-500"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $temoignages->links() }}</div>
</div>
@endsection
