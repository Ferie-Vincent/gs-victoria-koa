<section class="py-20" style="background-color: #FEF9C3;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <x-section-title title="Nos Chiffres" subtitle="Des résultats qui témoignent de notre engagement envers l'excellence éducative." />
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
            @php
            $stats = [
                ['value' => 10,  'suffix' => '+', 'label' => "ans d'Expériences", 'icon' => '<i class="fi fi-sr-school text-primary text-2xl"></i>',          'bg' => 'bg-violet-100', 'text' => 'text-primary'],
                ['value' => 12,  'suffix' => '',  'label' => 'Classes',            'icon' => '<i class="fi fi-sr-book text-secondary text-2xl"></i>',     'bg' => 'bg-amber-100',  'text' => 'text-secondary'],
                ['value' => 350, 'suffix' => '+', 'label' => 'Élèves',             'icon' => '<i class="fi fi-sr-child text-pink-600 text-2xl"></i>',       'bg' => 'bg-pink-100',   'text' => 'text-pink-600'],
                ['value' => 25,  'suffix' => '',  'label' => 'Enseignants',        'icon' => '<i class="fi fi-sr-chalkboard text-teal-600 text-2xl"></i>','bg' => 'bg-teal-100',   'text' => 'text-teal-600'],
            ];
            @endphp

            @foreach($stats as $i => $stat)
            <div class="text-center"
                 data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">

                {{-- Icône --}}
                <div class="w-16 h-16 {{ $stat['bg'] }} rounded-full flex items-center justify-center mx-auto mb-4">
                    {!! $stat['icon'] !!}
                </div>

                {{-- Compteur Alpine.js --}}
                <div x-data="{
                        value: 0,
                        target: {{ $stat['value'] }},
                        suffix: '{{ $stat['suffix'] }}',
                        started: false,
                        start() {
                            if (this.started) return;
                            this.started = true;
                            const step = Math.max(1, this.target / 60);
                            const interval = setInterval(() => {
                                this.value = Math.min(this.value + step, this.target);
                                if (this.value >= this.target) {
                                    this.value = this.target;
                                    clearInterval(interval);
                                }
                            }, 25);
                        }
                    }"
                     x-intersect:enter="start()">
                    <span class="font-display font-extrabold text-5xl {{ $stat['text'] }}"
                          x-text="Math.round(value) + suffix">0</span>
                </div>

                <p class="font-body font-semibold text-gray-700 mt-2 text-sm">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
