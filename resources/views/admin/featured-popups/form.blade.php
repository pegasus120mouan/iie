<div class="admin-page-header">
    <h1 class="admin-page-title">{{ isset($featuredPopup) ? 'Modifier' : 'Ajouter' }} une formation en vue</h1>
</div>

<form action="{{ isset($featuredPopup) ? route('admin.featured-popups.update', $featuredPopup) : route('admin.featured-popups.store') }}" method="POST" enctype="multipart/form-data" class="form-card max-w-2xl">
    @csrf
    @if(isset($featuredPopup)) @method('PUT') @endif

    <div class="space-y-6">
        <div>
            <label class="form-label">Titre (optionnel)</label>
            <input type="text" name="title" value="{{ old('title', $featuredPopup->title ?? '') }}" class="form-input" placeholder="Ex : Promo CCNA — Session Mars">
            @error('title')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="form-label">Image {{ isset($featuredPopup) ? '' : '*' }}</label>
            <input type="file" name="image" class="form-input" accept="image/jpeg,image/png,image/webp" {{ isset($featuredPopup) ? '' : 'required' }}>
            <p class="text-xs text-slate mt-2">JPG, PNG ou WebP — max 5 Mo. Format paysage ou carré recommandé.</p>
            @error('image')<p class="alert-error mt-2 !py-2">{{ $message }}</p>@enderror
            @if(isset($featuredPopup))
                <img src="{{ $featuredPopup->image_url }}" alt="Aperçu" class="mt-4 rounded-xl max-h-48 border border-primary/10">
            @endif
        </div>

        <div class="p-4 rounded-xl border border-primary/10 bg-primary-soft/50">
            <p class="form-label mb-1">Formation liée</p>
            <p class="font-semibold text-navy text-lg">{{ $promotionFormation->name }}</p>
            <p class="text-xs text-slate mt-2">Attribuée automatiquement à toutes les formations en vue pour le suivi des inscriptions promotionnelles.</p>
            <input type="hidden" name="formation_id" value="{{ $promotionFormation->id }}">
        </div>

        @if(isset($featuredPopup) && $featuredPopup->formation_id && $featuredPopup->slug)
            <div class="p-4 rounded-xl border border-gold/30 bg-gold/5">
                <label class="form-label text-navy"><i class="fas fa-share-alt text-gold mr-1"></i>Lien d'inscription dédié</label>
                <p class="text-xs text-slate mb-3">Partagez ce lien pour permettre une inscription uniquement à cette formation.</p>
                <div class="flex flex-col sm:flex-row gap-2">
                    <input type="text" readonly value="{{ $featuredPopup->share_url }}" class="form-input text-sm bg-white" id="share-link-{{ $featuredPopup->id }}">
                    <button type="button" class="btn-navy text-sm whitespace-nowrap px-4" onclick="copyShareLink('share-link-{{ $featuredPopup->id }}', this)">
                        <i class="fas fa-copy mr-1"></i>Copier
                    </button>
                </div>
                <a href="{{ $featuredPopup->share_url }}" target="_blank" class="inline-block text-xs text-gold font-semibold mt-3 hover:underline">
                    Ouvrir le lien <i class="fas fa-external-link-alt ml-1"></i>
                </a>
            </div>
        @endif

        <label class="flex items-center gap-3 p-4 rounded-xl border border-primary/10 bg-primary-soft/50 cursor-pointer">
            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-navy" {{ old('is_active', $featuredPopup->is_active ?? false) ? 'checked' : '' }}>
            <span>
                <span class="font-semibold text-navy block">Activer sur le site</span>
                <span class="text-sm text-slate">La popup s'affichera à chaque visite ou actualisation du site, jusqu'à ce que le visiteur la ferme.</span>
            </span>
        </label>
    </div>

    <div class="flex gap-4 mt-8">
        <button type="submit" class="btn-gold"><i class="fas fa-save mr-2"></i>Enregistrer</button>
        <a href="{{ route('admin.featured-popups.index') }}" class="btn-navy">Annuler</a>
    </div>
</form>

@if(isset($featuredPopup))
@push('scripts')
<script>
function copyShareLink(inputId, button) {
    const input = document.getElementById(inputId);
    navigator.clipboard.writeText(input.value).then(() => {
        const original = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check mr-1"></i>Copié !';
        setTimeout(() => { button.innerHTML = original; }, 2000);
    });
}
</script>
@endpush
@endif
