<section class="py-20 bg-section-alt relative overflow-hidden">

    @include('components.floating-bubbles')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="mb-14 text-center">
            <x-section-title title="Nos Valeurs" subtitle="Les principes qui guident chaque jour notre action éducative à VICTORIA-KOA." />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
            $values = [
                ['icon' => '<i class="fi fi-sr-bolt text-violet-600 text-3xl"></i>', 'bg' => 'bg-violet-100', 'text' => 'text-violet-700', 'shadow' => 'shadow-violet', 'border' => 'border-violet-100',
                 'stitchColor' => '#6D28D9',
                 'title' => 'Le Dynamisme',
                 'desc'  => "Un mot avec beaucoup de sens, le dynamisme permet aux élèves de surmonter toute épreuve, d'aller au-delà de leurs limites et de donner le meilleur d'eux-mêmes chaque jour."],
                ['icon' => '<i class="fi fi-sr-target text-amber-600 text-3xl"></i>', 'bg' => 'bg-amber-100', 'text' => 'text-amber-700', 'shadow' => 'shadow-yellow', 'border' => 'border-amber-100',
                 'stitchColor' => '#B45309',
                 'title' => 'La Persévérance',
                 'desc'  => "Une qualité essentielle qui consiste à persister dans ses efforts et à braver tout obstacle pour atteindre ses objectifs, quelles que soient les difficultés rencontrées."],
                ['icon' => '<i class="fi fi-sr-handshake text-teal-600 text-3xl"></i>', 'bg' => 'bg-teal-100', 'text' => 'text-teal-700', 'shadow' => 'shadow-teal', 'border' => 'border-teal-100',
                 'stitchColor' => '#0F766E',
                 'title' => "L'Esprit d'Équipe",
                 'desc'  => "À Victoria-Koa, l'esprit d'équipe est une valeur fondamentale que nous inculquons aux élèves afin de les préparer à la vie collective et professionnelle."],
            ];
            @endphp

            @foreach($values as $i => $value)
            <div class="float-card-wrap" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
            <div class="relative bg-white {{ $value['shadow'] }} rounded-3xl p-8 float-card border {{ $value['border'] }} group"
                 style="animation-delay: {{ $i * 1.5 }}s;">

                {{-- Effet cousu --}}
                <div class="absolute inset-3 pointer-events-none rounded-2xl"
                     style="border: 2px dashed {{ $value['stitchColor'] }}40;"></div>

                {{-- Icône --}}
                <div class="relative z-10 w-16 h-16 rounded-2xl {{ $value['bg'] }} flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    {!! $value['icon'] !!}
                </div>

                <h3 class="relative z-10 font-display font-bold text-xl text-dark mb-3 {{ $value['text'] }}">
                    {{ $value['title'] }}
                </h3>
                <p class="relative z-10 font-body text-gray-600 leading-relaxed text-sm">
                    {{ $value['desc'] }}
                </p>
            </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
