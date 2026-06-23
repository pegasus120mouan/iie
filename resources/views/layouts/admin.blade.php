<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Admin IIE</title>
    @include('partials.favicon')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-light dark:bg-gray-900">
    <aside class="admin-sidebar">
        <div class="p-6 border-b border-white/10">
            <x-logo :href="route('admin.dashboard')" variant="admin" />
            <div class="text-gold text-xs mt-2">Administration</div>
        </div>
        <nav class="p-4 space-y-1">
            @foreach([
                ['route' => 'admin.dashboard', 'icon' => 'fa-chart-pie', 'label' => 'Dashboard'],
                ['route' => 'admin.formations.index', 'icon' => 'fa-graduation-cap', 'label' => 'Formations'],
                ['route' => 'admin.inscriptions.index', 'icon' => 'fa-user-graduate', 'label' => 'Inscriptions'],
                ['route' => 'admin.actualites.index', 'icon' => 'fa-newspaper', 'label' => 'Actualités'],
                ['route' => 'admin.temoignages.index', 'icon' => 'fa-quote-left', 'label' => 'Témoignages'],
                ['route' => 'admin.galeries.index', 'icon' => 'fa-images', 'label' => 'Galerie'],
                ['route' => 'admin.contacts.index', 'icon' => 'fa-envelope', 'label' => 'Contacts'],
                ['route' => 'admin.users.index', 'icon' => 'fa-users-cog', 'label' => 'Utilisateurs'],
            ] as $item)
                <a href="{{ route($item['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition {{ request()->routeIs(str_replace('.index', '.*', $item['route'])) || request()->routeIs($item['route']) ? 'bg-gold text-navy font-semibold' : 'text-gray-300 hover:bg-white/10' }}">
                    <i class="fas {{ $item['icon'] }} w-5"></i>{{ $item['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-white/10">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-2 text-gray-300 hover:text-gold text-sm"><i class="fas fa-external-link-alt"></i>Voir le site</a>
            <form action="{{ route('admin.logout') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-2 text-gray-300 hover:text-red-400 text-sm w-full"><i class="fas fa-sign-out-alt"></i>Déconnexion</button>
            </form>
        </div>
    </aside>

    <main class="admin-content">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg mb-6"><i class="fas fa-check mr-2"></i>{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg mb-6"><i class="fas fa-exclamation mr-2"></i>{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
