document.addEventListener('DOMContentLoaded', () => {
    document.documentElement.classList.remove('dark');
    localStorage.removeItem('theme');

    const header = document.getElementById('main-header');
    if (header) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('header-scrolled');
                header.classList.remove('header-transparent');
            } else {
                header.classList.remove('header-scrolled');
                header.classList.add('header-transparent');
            }
        });
    }

    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    mobileMenuBtn?.addEventListener('click', () => {
        mobileMenu?.classList.toggle('hidden');
    });

    // Mega menu desktop — clic + survol
    const megaWrapper = document.getElementById('mega-menu-wrapper');
    const megaTrigger = document.getElementById('mega-menu-trigger');
    const megaPanel = document.getElementById('mega-menu-panel');
    let megaCloseTimer = null;

    const openMegaMenu = () => {
        clearTimeout(megaCloseTimer);
        megaWrapper?.classList.add('is-open');
        megaTrigger?.setAttribute('aria-expanded', 'true');
    };

    const closeMegaMenu = () => {
        megaCloseTimer = setTimeout(() => {
            megaWrapper?.classList.remove('is-open');
            megaTrigger?.setAttribute('aria-expanded', 'false');
        }, 150);
    };

    megaWrapper?.addEventListener('mouseenter', openMegaMenu);
    megaWrapper?.addEventListener('mouseleave', closeMegaMenu);

    megaTrigger?.addEventListener('click', (event) => {
        if (window.innerWidth < 1024) {
            return;
        }

        if (!megaWrapper?.classList.contains('is-open')) {
            event.preventDefault();
            openMegaMenu();
        }
    });

    document.addEventListener('click', (event) => {
        if (!megaWrapper?.contains(event.target)) {
            megaWrapper?.classList.remove('is-open');
            megaTrigger?.setAttribute('aria-expanded', 'false');
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            megaWrapper?.classList.remove('is-open');
            megaTrigger?.setAttribute('aria-expanded', 'false');
        }
    });

    // Mega menu mobile
    const mobileFormationsToggle = document.getElementById('mobile-formations-toggle');
    const mobileFormationsMenu = document.getElementById('mobile-formations-menu');
    const mobileFormationsChevron = document.getElementById('mobile-formations-chevron');

    mobileFormationsToggle?.addEventListener('click', () => {
        const isOpen = mobileFormationsMenu?.classList.toggle('hidden') === false;
        mobileFormationsToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        mobileFormationsChevron?.classList.toggle('rotate-180', isOpen);
    });

    const slides = document.querySelectorAll('.hero-slider .slide');
    if (slides.length > 1) {
        let current = 0;
        setInterval(() => {
            slides[current].classList.remove('active');
            current = (current + 1) % slides.length;
            slides[current].classList.add('active');
        }, 6000);
    }

    // Popup Formation en vue — réapparaît à chaque chargement / actualisation de page
    const featuredPopup = document.getElementById('featured-popup');
    if (featuredPopup) {
        const closeFeaturedPopup = () => {
            featuredPopup.classList.add('hidden');
            document.body.classList.remove('featured-popup-open');
        };

        featuredPopup.querySelectorAll('[data-close-popup]').forEach((el) => {
            el.addEventListener('click', () => {
                closeFeaturedPopup();
            });
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && !featuredPopup.classList.contains('hidden')) {
                closeFeaturedPopup();
            }
        });

        featuredPopup.classList.remove('hidden');
        document.body.classList.add('featured-popup-open');
    }
});
