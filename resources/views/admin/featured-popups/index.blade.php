@extends('layouts.admin')

@section('title', 'Formation en vue')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Formation en vue</h1>
        <p class="admin-page-subtitle">Affichez une image en popup sur le site public. Une seule peut être active à la fois.</p>
    </div>
    <a href="{{ route('admin.featured-popups.create') }}" class="btn-gold"><i class="fas fa-plus mr-2"></i>Ajouter</a>
</div>

@if($popups->where('is_active', true)->isNotEmpty())
    <div class="admin-alert-success mb-6">
        <i class="fas fa-check-circle"></i>
        Une popup est actuellement visible sur le site public.
    </div>
@else
    <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-xl mb-6 text-sm">
        <i class="fas fa-info-circle mr-2"></i>Aucune popup active pour le moment.
    </div>
@endif

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($popups as $popup)
        <div class="feature-card !p-0 overflow-hidden">
            <div class="aspect-[4/3] bg-primary-soft relative">
                <img src="{{ $popup->image_url }}" alt="{{ $popup->title ?? 'Formation en vue' }}" class="w-full h-full object-cover">
                @if($popup->is_active)
                    <span class="absolute top-3 left-3 badge-status badge-active">Active</span>
                @endif
            </div>
            <div class="p-5">
                <h3 class="font-bold text-navy">{{ $popup->title ?? 'Sans titre' }}</h3>
                @if($popup->formation)
                    <p class="text-xs text-slate mt-1"><i class="fas fa-graduation-cap mr-1 text-gold"></i>{{ $popup->formation->name }}</p>
                    @if($popup->slug)
                        <div class="mt-3 p-3 rounded-lg bg-primary-soft/60 border border-primary/10">
                            <p class="text-xs font-semibold text-navy mb-1"><i class="fas fa-share-alt text-gold mr-1"></i>Lien d'inscription</p>
                            <p class="text-xs text-slate break-all">{{ $popup->share_url }}</p>
                        </div>
                    @endif
                @endif
                <p class="text-xs text-slate mt-2">{{ $popup->created_at->format('d/m/Y H:i') }}</p>
                <div class="flex flex-wrap gap-2 mt-4">
                    <form action="{{ route('admin.featured-popups.toggle', $popup) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="text-sm px-3 py-1.5 rounded-lg font-semibold transition {{ $popup->is_active ? 'bg-amber-100 text-amber-800 hover:bg-amber-200' : 'bg-green-100 text-green-800 hover:bg-green-200' }}">
                            {{ $popup->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>
                    <a href="{{ route('admin.featured-popups.edit', $popup) }}" class="text-sm px-3 py-1.5 rounded-lg bg-primary-light text-navy font-semibold hover:bg-primary/20 transition">
                        <i class="fas fa-edit"></i> Modifier
                    </a>
                    <form action="{{ route('admin.featured-popups.destroy', $popup) }}" method="POST" onsubmit="return confirm('Supprimer cette popup ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-sm px-3 py-1.5 rounded-lg bg-red-50 text-red-600 font-semibold hover:bg-red-100 transition">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full empty-state">
            <div class="empty-state-icon"><i class="fas fa-window-restore"></i></div>
            <p class="text-slate font-medium">Aucune formation en vue pour le moment.</p>
            <a href="{{ route('admin.featured-popups.create') }}" class="btn-gold mt-6">Créer la première</a>
        </div>
    @endforelse
</div>

<div class="mt-8">{{ $popups->links() }}</div>
@endsection
