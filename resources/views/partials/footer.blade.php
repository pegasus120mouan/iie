<footer class="site-footer">
  <div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
      <div>
        <div class="mb-6">
          <x-logo variant="footer" />
        </div>
        <p class="text-slate text-sm leading-relaxed">{{ config('iie.tagline') }}. Formations professionnelles de qualité internationale.</p>
        <div class="flex gap-3 mt-6">
          <a href="{{ config('iie.social.facebook') }}" class="social-link" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="{{ config('iie.social.twitter') }}" class="social-link" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="{{ config('iie.social.linkedin') }}" class="social-link" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
          <a href="{{ config('iie.social.instagram') }}" class="social-link" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        </div>
      </div>

      <div>
        <h4 class="site-footer-heading">Liens rapides</h4>
        <ul class="space-y-3 text-slate">
          <li><a href="{{ route('about') }}" class="hover:text-navy transition"><i class="fas fa-chevron-right text-xs mr-2 text-gold"></i>À propos</a></li>
          <li><a href="{{ route('formations.index') }}" class="hover:text-navy transition"><i class="fas fa-chevron-right text-xs mr-2 text-gold"></i>Formations</a></li>
          <li><a href="{{ route('inscription.create') }}" class="hover:text-navy transition"><i class="fas fa-chevron-right text-xs mr-2 text-gold"></i>Inscription</a></li>
          <li><a href="{{ route('actualites.index') }}" class="hover:text-navy transition"><i class="fas fa-chevron-right text-xs mr-2 text-gold"></i>Actualités</a></li>
          <li><a href="{{ route('galerie') }}" class="hover:text-navy transition"><i class="fas fa-chevron-right text-xs mr-2 text-gold"></i>Galerie</a></li>
        </ul>
      </div>

      <div>
        <h4 class="site-footer-heading">Formations populaires</h4>
        <ul class="space-y-3 text-slate">
          @foreach(\App\Models\Formation::where('is_popular', true)->take(5)->get() as $f)
            <li><a href="{{ route('formations.show', $f->slug) }}" class="hover:text-navy transition"><i class="fas fa-chevron-right text-xs mr-2 text-gold"></i>{{ $f->name }}</a></li>
          @endforeach
        </ul>
      </div>

      <div>
        <h4 class="site-footer-heading">Contact</h4>
        <ul class="space-y-4 text-slate text-sm">
          <li class="flex items-start gap-3"><i class="fas fa-map-marker-alt text-gold mt-1"></i>{{ config('iie.address') }}</li>
          <li class="flex items-center gap-3"><i class="fas fa-phone text-gold"></i>{{ config('iie.phone') }}</li>
          <li class="flex items-center gap-3"><i class="fas fa-envelope text-gold"></i>{{ config('iie.email') }}</li>
          <li class="flex items-center gap-3"><i class="fab fa-whatsapp text-gold"></i>{{ config('iie.whatsapp') }}</li>
        </ul>
      </div>
    </div>
  </div>

  <div class="border-t border-primary/10 bg-primary-soft">
    <div class="container mx-auto px-4 py-6 flex flex-col md:flex-row justify-between items-center text-sm text-slate">
      <p>&copy; {{ date('Y') }} {{ config('iie.name') }}. Tous droits réservés.</p>
      <p class="mt-2 md:mt-0">Conçu avec excellence <i class="fas fa-heart text-gold"></i></p>
    </div>
  </div>
</footer>
