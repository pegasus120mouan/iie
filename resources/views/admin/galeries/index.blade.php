@extends('layouts.admin')

@section('title', 'Galerie')

@section('content')
<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-navy dark:text-white">Galerie</h1>
    <a href="{{ route('admin.galeries.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>
<div class="grid md:grid-cols-3 gap-6">
    @foreach($galeries as $g)
        <div class="bg-white dark:bg-gray-800 rounded-xl p-4 card-shadow">
            <div class="aspect-video bg-navy rounded-lg flex items-center justify-center mb-3">
                <i class="fas {{ $g->type === 'video' ? 'fa-video' : 'fa-image' }} text-gold text-3xl"></i>
            </div>
            <h4 class="font-semibold">{{ $g->title }}</h4>
            <p class="text-sm text-gray-500">{{ $g->category }} · {{ $g->type }}</p>
            <div class="flex gap-2 mt-3">
                <a href="{{ route('admin.galeries.edit', $g) }}" class="text-blue-500 text-sm"><i class="fas fa-edit"></i> Modifier</a>
                <form action="{{ route('admin.galeries.destroy', $g) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="text-red-500 text-sm"><i class="fas fa-trash"></i></button></form>
            </div>
        </div>
    @endforeach
</div>
<div class="mt-8">{{ $galeries->links() }}</div>
@endsection
