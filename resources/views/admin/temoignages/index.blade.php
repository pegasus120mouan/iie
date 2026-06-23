@extends('layouts.admin')

@section('title', 'Témoignages')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-navy dark:text-white">Témoignages</h1>
    <a href="{{ route('admin.temoignages.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>
<div class="bg-white dark:bg-gray-800 rounded-xl card-shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-navy text-white"><tr><th class="text-left py-3 px-4">Nom</th><th class="text-left py-3 px-4">Formation</th><th class="text-left py-3 px-4">Note</th><th class="text-left py-3 px-4">Actif</th><th class="text-right py-3 px-4">Actions</th></tr></thead>
        <tbody>
            @foreach($temoignages as $t)
                <tr class="border-b dark:border-gray-700">
                    <td class="py-3 px-4 font-semibold">{{ $t->name }}</td>
                    <td class="py-3 px-4">{{ $t->formation }}</td>
                    <td class="py-3 px-4 text-gold">@for($i=0;$i<$t->rating;$i++)<i class="fas fa-star text-xs"></i>@endfor</td>
                    <td class="py-3 px-4">{{ $t->is_active ? 'Oui' : 'Non' }}</td>
                    <td class="py-3 px-4 text-right space-x-2">
                        <a href="{{ route('admin.temoignages.edit', $t) }}" class="text-blue-500"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.temoignages.destroy', $t) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="text-red-500"><i class="fas fa-trash"></i></button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-4">{{ $temoignages->links() }}</div>
</div>
@endsection
