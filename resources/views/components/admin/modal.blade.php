@props(['title', 'size' => 'max-w-2xl'])

<div x-show="open"
     x-cloak
     class="fixed inset-0 z-50 flex items-center justify-center p-4"
     @keydown.escape.window="open = false">

    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"></div>

    {{-- Panel --}}
    <div class="relative bg-white rounded-2xl shadow-2xl w-full {{ $size }} max-h-[92vh] flex flex-col overflow-hidden"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-2">

        {{-- Header violet (inline style = pas besoin de recompile Tailwind) --}}
        <div class="flex items-center justify-between px-6 py-4 flex-shrink-0"
             style="background: linear-gradient(to right, #6d28d9, #7c3aed);">
            <h2 class="font-bold text-white text-base flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-white opacity-60"></span>
                {{ $title }}
            </h2>
            <button type="button" @click="open = false"
                    class="w-8 h-8 rounded-xl flex items-center justify-center transition-colors"
                    style="background: rgba(255,255,255,0.15);"
                    onmouseover="this.style.background='rgba(255,255,255,0.25)'"
                    onmouseout="this.style.background='rgba(255,255,255,0.15)'"
                    data-tooltip="Fermer">
                <i class="fi fi-rr-cross text-white text-xs"></i>
            </button>
        </div>

        {{-- Contenu scrollable --}}
        <div class="overflow-y-auto flex-1 p-6 bg-gray-50">
            {{ $slot }}
        </div>
    </div>
</div>
