@extends('layouts.admin')

@section('title', 'Inscriptions')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-navy dark:text-white">Inscriptions</h1>
</div>

<form method="GET" class="flex gap-4 mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="form-input max-w-xs">
    <select name="statut" class="form-input max-w-xs">
        <option value="">Tous les statuts</option>
        @foreach(['en_attente', 'validee', 'refusee', 'annulee'] as $s)
            <option value="{{ $s }}" {{ request('statut') === $s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn-navy">Filtrer</button>
</form>

<div class="bg-white dark:bg-gray-800 rounded-xl card-shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-navy text-white">
            <tr>
                <th class="text-left py-3 px-4">N° Dossier</th>
                <th class="text-left py-3 px-4">Nom</th>
                <th class="text-left py-3 px-4">Formation</th>
                <th class="text-left py-3 px-4">Email</th>
                <th class="text-left py-3 px-4">Statut</th>
                <th class="text-left py-3 px-4">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inscriptions as $ins)
                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer" onclick="window.location='{{ route('admin.inscriptions.show', $ins) }}'">
                    <td class="py-3 px-4 font-semibold text-gold">{{ $ins->numero_dossier }}</td>
                    <td class="py-3 px-4">{{ $ins->full_name }}</td>
                    <td class="py-3 px-4">{{ $ins->formation->name }}</td>
                    <td class="py-3 px-4">{{ $ins->email }}</td>
                    <td class="py-3 px-4"><span class="px-2 py-1 rounded text-xs bg-yellow-100 text-yellow-800">{{ $ins->statut }}</span></td>
                    <td class="py-3 px-4">{{ $ins->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $inscriptions->withQueryString()->links() }}</div>
</div>
@endsection
