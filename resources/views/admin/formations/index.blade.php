@extends('layouts.admin')

@section('title', 'Formations')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-navy dark:text-white">Formations</h1>
    <a href="{{ route('admin.formations.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl card-shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-navy text-white">
            <tr>
                <th class="text-left py-3 px-4">Nom</th>
                <th class="text-left py-3 px-4">Catégorie</th>
                <th class="text-left py-3 px-4">Durée</th>
                <th class="text-left py-3 px-4">Prix</th>
                <th class="text-left py-3 px-4">Statut</th>
                <th class="text-right py-3 px-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($formations as $f)
                <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="py-3 px-4 font-semibold">{{ $f->name }}</td>
                    <td class="py-3 px-4">{{ $f->category->name }}</td>
                    <td class="py-3 px-4">{{ $f->duration }}</td>
                    <td class="py-3 px-4 text-gold font-semibold">{{ $f->formatted_price }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 rounded text-xs {{ $f->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $f->is_active ? 'Actif' : 'Inactif' }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-right space-x-2">
                        <a href="{{ route('admin.formations.edit', $f) }}" class="text-blue-500 hover:text-blue-700"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.formations.destroy', $f) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $formations->links() }}</div>
</div>
@endsection
