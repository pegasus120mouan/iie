@extends('layouts.admin')

@section('title', 'Galerie')

@section('content')
<div class="admin-page-header">
    <h1 class="admin-page-title">Galerie</h1>
    <a href="{{ route('admin.galeries.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>
<div class="grid md:grid-cols-3 gap-6">
    @foreach($galeries as $g)
        <div class="feature-card !p-4">
            <div class="aspect-video rounded-xl flex items-center justify-center mb-4 bg-gradient-blue">
                <i class="fas {{ $g->type === 'video' ? 'fa-video' : 'fa-image' }} text-white text-3xl"></i>
            </div>
            <h4 class="font-semibold text-navy">{{ $g->title }}</h4>
            <p class="text-sm text-slate">{{ $g->category }} · {{ $g->type }}</p>
            <div class="flex gap-3 mt-4">
                <a href="{{ route('admin.galeries.edit', $g) }}" class="text-navy hover:text-gold text-sm transition"><i class="fas fa-edit"></i> Modifier</a>
                <form action="{{ route('admin.galeries.destroy', $g) }}" method="POST" class="inline" onsubmit="return confirm('Supprimer ?')">@csrf @method('DELETE')<button class="text-red-500 text-sm hover:text-red-700 transition"><i class="fas fa-trash"></i></button></form>
            </div>
        </div>
    @endforeach
</div>
<div class="mt-8">{{ $galeries->links() }}</div>
@endsection
