@props([
    'title',
    'subtitle' => null,
    'badge' => null,
    'align' => 'center',
    'breadcrumbs' => [],
])

<section {{ $attributes->merge(['class' => 'page-hero pt-32 ' . ($subtitle || $badge || $slot->isNotEmpty() ? 'pb-16' : 'pb-20')]) }}>
    <div class="container mx-auto px-4 {{ $align === 'center' ? 'text-center max-w-4xl' : 'max-w-5xl' }}" data-aos="fade-up">
        @if(count($breadcrumbs))
            <nav class="breadcrumb {{ $align === 'center' ? 'justify-center' : '' }}" aria-label="Fil d'Ariane">
                @foreach($breadcrumbs as $item)
                    @if(!$loop->first)
                        <span class="breadcrumb-sep" aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
                    @endif
                    @if(!empty($item['url']))
                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a>
                    @else
                        <span class="breadcrumb-current">{{ $item['label'] }}</span>
                    @endif
                @endforeach
            </nav>
        @endif

        @if($badge)
            <span class="meta-badge">{{ $badge }}</span>
        @endif

        <h1 class="page-title">{{ $title }}</h1>

        @if($subtitle)
            <p class="page-subtitle {{ $align === 'center' ? 'mx-auto' : '' }}">{{ $subtitle }}</p>
        @endif

        {{ $slot }}
    </div>
</section>
