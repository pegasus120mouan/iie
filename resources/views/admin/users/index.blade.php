@extends('layouts.admin')

@section('title', 'Utilisateurs')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-navy dark:text-white">Utilisateurs</h1>
    <a href="{{ route('admin.users.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>
<div class="bg-white dark:bg-gray-800 rounded-xl card-shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-navy text-white"><tr><th class="text-left py-3 px-4">Nom</th><th class="text-left py-3 px-4">Email</th><th class="text-left py-3 px-4">Rôle</th><th class="text-left py-3 px-4">Actif</th><th class="text-right py-3 px-4">Actions</th></tr></thead>
        <tbody>
            @foreach($users as $u)
                <tr class="border-b dark:border-gray-700">
                    <td class="py-3 px-4 font-semibold">{{ $u->name }}</td>
                    <td class="py-3 px-4">{{ $u->email }}</td>
                    <td class="py-3 px-4">{{ $u->role?->label ?? '-' }}</td>
                    <td class="py-3 px-4">{{ $u->is_active ? 'Oui' : 'Non' }}</td>
                    <td class="py-3 px-4 text-right space-x-2">
                        <a href="{{ route('admin.users.edit', $u) }}" class="text-blue-500"><i class="fas fa-edit"></i></a>
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
