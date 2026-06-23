@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-navy dark:text-white">Dashboard</h1>
    <p class="text-gray-500">Bienvenue, {{ auth()->user()->name }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @foreach([
        ['label' => 'Inscriptions totales', 'value' => $stats['inscriptions_total'], 'icon' => 'fa-user-graduate', 'color' => 'bg-blue-500'],
        ['label' => 'Ce mois', 'value' => $stats['inscriptions_mois'], 'icon' => 'fa-calendar', 'color' => 'bg-green-500'],
        ['label' => 'Formations actives', 'value' => $stats['formations_total'], 'icon' => 'fa-book', 'color' => 'bg-purple-500'],
        ['label' => 'Revenus', 'value' => number_format($stats['revenus'], 0, ',', ' ').' F', 'icon' => 'fa-coins', 'color' => 'bg-gold'],
    ] as $stat)
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 card-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">{{ $stat['label'] }}</p>
                    <p class="text-2xl font-bold text-navy dark:text-white mt-1">{{ $stat['value'] }}</p>
                </div>
                <div class="w-12 h-12 {{ $stat['color'] }} rounded-lg flex items-center justify-center text-white">
                    <i class="fas {{ $stat['icon'] }}"></i>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-2 gap-8">
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 card-shadow">
        <h3 class="text-lg font-bold text-navy dark:text-white mb-4">Formations les plus demandées</h3>
        <div class="space-y-4">
            @foreach($formationsPopulaires as $f)
                <div class="flex items-center justify-between">
                    <span class="text-gray-700 dark:text-gray-300">{{ $f->name }}</span>
                    <span class="bg-gold/10 text-gold px-3 py-1 rounded-full text-sm font-semibold">{{ $f->inscriptions_count }} inscrits</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 card-shadow">
        <h3 class="text-lg font-bold text-navy dark:text-white mb-4">Répartition par filière</h3>
        <div class="space-y-4">
            @foreach($repartitionCategories as $cat)
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span>{{ $cat['name'] }}</span>
                        <span class="font-semibold">{{ $cat['count'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                        <div class="bg-gold h-2 rounded-full" style="width: {{ $stats['inscriptions_total'] > 0 ? ($cat['count'] / $stats['inscriptions_total'] * 100) : 0 }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="mt-8 bg-white dark:bg-gray-800 rounded-xl p-6 card-shadow">
    <h3 class="text-lg font-bold text-navy dark:text-white mb-4">Inscriptions récentes</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="border-b dark:border-gray-700">
                <th class="text-left py-3 px-2">N° Dossier</th>
                <th class="text-left py-3 px-2">Nom</th>
                <th class="text-left py-3 px-2">Formation</th>
                <th class="text-left py-3 px-2">Statut</th>
                <th class="text-left py-3 px-2">Date</th>
            </tr></thead>
            <tbody>
                @foreach($inscriptionsRecentes as $ins)
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="py-3 px-2"><a href="{{ route('admin.inscriptions.show', $ins) }}" class="text-gold font-semibold">{{ $ins->numero_dossier }}</a></td>
                        <td class="py-3 px-2">{{ $ins->full_name }}</td>
                        <td class="py-3 px-2">{{ $ins->formation->name }}</td>
                        <td class="py-3 px-2"><span class="px-2 py-1 rounded text-xs bg-yellow-100 text-yellow-800">{{ $ins->statut }}</span></td>
                        <td class="py-3 px-2">{{ $ins->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
