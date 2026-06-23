@php
    $categories = \App\Models\Category::where('is_active', true)->with(['formations' => fn($q) => $q->where('is_active', true)->take(5)])->orderBy('sort_order')->get();
@endphp

<header id="main-header" class="header-sticky header-transparent">
  <div class="header-topbar">
    <div class="container mx-auto px-4 py-2 flex justify-between items-center">
      <div class="flex items-center gap-4">
        <a href="tel:{{ config('iie.phone') }}" class="hover:text-gold-light transition"><i class="fas fa-phone mr-1"></i>{{ config('iie.phone') }}</a>
        <a href="mailto:{{ config('iie.email') }}" class="hover:text-gold-light transition hidden sm:inline"><i class="fas fa-envelope mr-1"></i>{{ config('iie.email') }}</a>
      </div>
      <div class="flex items-center gap-3">
        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', config('iie.whatsapp')) }}" target="_blank" class="hover:text-gold-light transition"><i class="fab fa-whatsapp"></i></a>
        <a href="{{ config('iie.social.facebook') }}" class="hover:text-gold-light transition"><i class="fab fa-facebook-f"></i></a>
        <a href="{{ config('iie.social.linkedin') }}" class="hover:text-gold-light transition"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </div>

  <div class="header-main">
    <nav class="container mx-auto px-4 py-4 lg:py-5">
      <div class="flex items-center justify-between">
        <x-logo variant="header" />

        <div class="hidden lg:flex items-center gap-8">
          <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">Accueil</a>
          <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'nav-link-active' : '' }}">À propos</a>

          <div class="relative group">
            <a href="{{ route('formations.index') }}" class="nav-link flex items-center gap-1 {{ request()->routeIs('formations.*') ? 'nav-link-active' : '' }}">
              Formations <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
            </a>
            <div class="mega-menu-panel">
              <div class="mega-menu-card">
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-x-8 gap-y-6">
                  @foreach($categories as $cat)
                    <div class="min-w-0">
                      <h4 class="text-navy font-semibold mb-3 flex items-start gap-2 text-sm leading-snug">
                        <i class="fas {{ $cat->icon ?? 'fa-graduation-cap' }} mt-0.5 shrink-0 text-gold"></i>
                        <span>{{ $cat->name }}</span>
                      </h4>
                      <ul class="space-y-2 text-sm">
                        @foreach($cat->formations as $formation)
                          <li>
                            <a href="{{ route('formations.show', $formation->slug) }}" class="block text-slate hover:text-navy transition leading-snug">
                              {{ $formation->name }}
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  @endforeach
                </div>
                <div class="mt-6 pt-4 border-t border-primary/10 text-center">
                  <a href="{{ route('formations.index') }}" class="text-navy hover:text-gold transition text-sm font-semibold">
                    Voir toutes les formations <i class="fas fa-arrow-right ml-1"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <a href="{{ route('actualites.index') }}" class="nav-link {{ request()->routeIs('actualites.*') ? 'nav-link-active' : '' }}">Actualités</a>
          <a href="{{ route('galerie') }}" class="nav-link {{ request()->routeIs('galerie') ? 'nav-link-active' : '' }}">Galerie</a>
          <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'nav-link-active' : '' }}">Contact</a>
          <a href="{{ route('inscription.create') }}" class="btn-gold text-sm !py-2 !px-4">
            <i class="fas fa-user-plus mr-2"></i>S'inscrire
          </a>
        </div>

        <button id="mobile-menu-btn" class="lg:hidden text-2xl text-navy" aria-label="Menu">
          <i class="fas fa-bars"></i>
        </button>
      </div>

      <div id="mobile-menu" class="lg:hidden hidden mt-4 pb-4 border-t border-primary/10 pt-4">
        <div class="flex flex-col gap-3">
          <a href="{{ route('home') }}" class="py-2 nav-link">Accueil</a>
          <a href="{{ route('about') }}" class="py-2 nav-link">À propos</a>
          <a href="{{ route('formations.index') }}" class="py-2 nav-link">Formations</a>
          <a href="{{ route('actualites.index') }}" class="py-2 nav-link">Actualités</a>
          <a href="{{ route('galerie') }}" class="py-2 nav-link">Galerie</a>
          <a href="{{ route('contact') }}" class="py-2 nav-link">Contact</a>
          <a href="{{ route('inscription.create') }}" class="btn-gold text-center mt-2">S'inscrire maintenant</a>
        </div>
      </div>
    </nav>
  </div>
</header>
