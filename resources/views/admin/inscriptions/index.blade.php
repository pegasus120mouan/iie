@extends('layouts.admin')

@section('title', 'Inscriptions')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">Inscriptions</h1></div>

<form method="GET" class="flex flex-wrap gap-4 mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="form-input max-w-xs">
    <select name="statut" class="form-input max-w-xs">
        <option value="">Tous les statuts</option>
        @foreach(['en_attente', 'validee', 'refusee', 'annulee'] as $s)
            <option value="{{ $s }}" {{ request('statut') === $s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-navy">Filtrer</button>
</form>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>N° Dossier</th>
                <th>Nom</th>
                <th>Formation</th>
                <th>Source</th>
                <th>Email</th>
                <th>Statut</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inscriptions as $ins)
                <tr class="cursor-pointer" onclick="window.location='{{ route('admin.inscriptions.show', $ins) }}'">
                    <td class="font-semibold text-gold">{{ $ins->numero_dossier }}</td>
                    <td class="font-medium text-navy">{{ $ins->full_name }}</td>
                    <td>{{ $ins->formation->name }}</td>
                    <td>
                        @if($ins->featured_popup_id)
                            <span class="badge-status badge-pending text-xs">Formation en vue</span>
                        @else
                            <span class="text-slate">—</span>
                        @endif
                    </td>
                    <td class="text-slate">{{ $ins->email }}</td>
                    <td><span class="badge-status badge-pending">{{ $ins->statut }}</span></td>
                    <td class="text-slate">{{ $ins->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4 border-t border-primary/8">{{ $inscriptions->withQueryString()->links() }}</div>
</div>
@endsection
