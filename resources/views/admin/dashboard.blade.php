@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Dashboard</h1>
        <p class="admin-page-subtitle">Bienvenue, {{ auth()->user()->name }}</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @foreach([
        ['label' => 'Inscriptions totales', 'value' => $stats['inscriptions_total'], 'icon' => 'fa-user-graduate', 'color' => 'admin-stat-icon-blue'],
        ['label' => 'Ce mois', 'value' => $stats['inscriptions_mois'], 'icon' => 'fa-calendar', 'color' => 'admin-stat-icon-green'],
        ['label' => 'Formations actives', 'value' => $stats['formations_total'], 'icon' => 'fa-book', 'color' => 'admin-stat-icon-purple'],
        ['label' => 'Revenus', 'value' => number_format($stats['revenus'], 0, ',', ' ').' F', 'icon' => 'fa-coins', 'color' => 'admin-stat-icon-gold'],
    ] as $stat)
        <div class="admin-stat-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-slate text-sm">{{ $stat['label'] }}</p>
                    <p class="text-2xl font-bold text-navy mt-1">{{ $stat['value'] }}</p>
                </div>
                <div class="admin-stat-icon {{ $stat['color'] }}">
                    <i class="fas {{ $stat['icon'] }}"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-2 gap-8">
    <div class="admin-card admin-card-body">
        <h3 class="content-heading-sm">Formations les plus demandées</h3>
        <div class="space-y-4 mt-6">
            @foreach($formationsPopulaires as $f)
                <div class="flex items-center justify-between gap-4">
                    <span class="text-slate">{{ $f->name }}</span>
                    <span class="badge-status badge-pending">{{ $f->inscriptions_count }} inscrits</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="admin-card admin-card-body">
        <h3 class="content-heading-sm">Répartition par filière</h3>
        <div class="space-y-5 mt-6">
            @foreach($repartitionCategories as $cat)
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-slate">{{ $cat['name'] }}</span>
                        <span class="font-semibold text-navy">{{ $cat['count'] }}</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" style="width: {{ $stats['inscriptions_total'] > 0 ? ($cat['count'] / $stats['inscriptions_total'] * 100) : 0 }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="mt-8 admin-card">
    <div class="admin-card-body border-b border-primary/8">
        <h3 class="content-heading-sm !mb-0">Inscriptions récentes</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>N° Dossier</th>
                    <th>Nom</th>
                    <th>Formation</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inscriptionsRecentes as $ins)
                    <tr>
                        <td><a href="{{ route('admin.inscriptions.show', $ins) }}" class="text-gold font-semibold hover:underline">{{ $ins->numero_dossier }}</a></td>
                        <td class="font-medium text-navy">{{ $ins->full_name }}</td>
                        <td>{{ $ins->formation->name }}</td>
                        <td><span class="badge-status badge-pending">{{ $ins->statut }}</span></td>
                        <td class="text-slate">{{ $ins->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
