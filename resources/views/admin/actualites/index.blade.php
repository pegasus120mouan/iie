@extends('layouts.admin')

@section('title', 'Actualités')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-navy dark:text-white">Actualités</h1>
    <a href="{{ route('admin.actualites.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>

<div class="bg-white dark:bg-gray-800 rounded-xl card-shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-navy text-white"><tr>
            <th class="text-left py-3 px-4">Titre</th>
            <th class="text-left py-3 px-4">Type</th>
            <th class="text-left py-3 px-4">Statut</th>
            <th class="text-left py-3 px-4">Date</th>
            <th class="text-right py-3 px-4">Actions</th>
        </tr></thead>
        <tbody>
            @foreach($actualites as $a)
                <tr class="border-b dark:border-gray-700">
                    <td class="py-3 px-4 font-semibold">{{ $a->title }}</td>
                    <td class="py-3 px-4">{{ $a->type_label }}</td>
                    <td class="py-3 px-4">{{ $a->is_published ? 'Publié' : 'Brouillon' }}</td>
                    <td class="py-3 px-4">{{ $a->created_at->format('d/m/Y') }}</td>
                    <td class="py-3 px-4 text-right space-x-2">
                        <a href="{{ route('admin.actualites.edit', $a) }}" class="text-blue-500"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.actualites.destroy', $a) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="text-red-500"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $actualites->links() }}</div>
</div>
@endsection
