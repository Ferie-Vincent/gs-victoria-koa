<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuration initiale — GS Victoria-Koa</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-2-2.png') }}">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-rounded/css/uicons-solid-rounded.css">
    @vite('resources/css/app.css')
    <style>
        body {
            background: #0F0C29;
            background: linear-gradient(135deg, #1E1B4B 0%, #312E81 50%, #4C1D95 100%);
            min-height: 100vh;
        }
        /* Dot pattern */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }
        .field-wrap {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.14);
            border-radius: 14px;
            transition: border-color 0.2s, background 0.2s;
        }
        .field-wrap:focus-within {
            border-color: rgba(167, 139, 250, 0.6);
            background: rgba(255,255,255,0.12);
        }
        .field-wrap input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .field-wrap input::placeholder { color: rgba(255,255,255,0.3); font-weight: 400; }
        .field-wrap label {
            display: block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(167, 139, 250, 0.9);
            margin-bottom: 2px;
        }
        .step-dot {
            width: 8px; height: 8px;
            border-radius: 50%;
            background: rgba(255,255,255,0.2);
        }
        .step-dot.active { background: #A78BFA; }
        .step-dot.done   { background: #34D399; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

{{-- Blobs déco --}}
<div class="fixed top-0 left-0 w-96 h-96 rounded-full pointer-events-none"
     style="background: radial-gradient(circle, rgba(124,58,237,0.25) 0%, transparent 70%); transform: translate(-30%, -30%);"></div>
<div class="fixed bottom-0 right-0 w-96 h-96 rounded-full pointer-events-none"
     style="background: radial-gradient(circle, rgba(236,72,153,0.2) 0%, transparent 70%); transform: translate(30%, 30%);"></div>

<div class="relative w-full max-w-md">

    {{-- Logo + titre --}}
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/10 ring-2 ring-white/10 mb-4 backdrop-blur-sm">
            <img src="{{ asset('images/logo/logo-2-2.png') }}" alt="Logo" class="w-12 h-12 object-contain">
        </div>
        <h1 class="text-white font-bold text-2xl tracking-tight mb-1">GS Victoria-Koa</h1>
        <p class="text-purple-300 text-sm">Configuration initiale de la plateforme</p>
    </div>

    {{-- Card --}}
    <div class="glass-card rounded-3xl p-8">

        {{-- Steps indicator --}}
        <div class="flex items-center gap-2 mb-7">
            <div class="step-dot done"></div>
            <div class="flex-1 h-px" style="background: rgba(52,211,153,0.4);"></div>
            <div class="step-dot done"></div>
            <div class="flex-1 h-px" style="background: rgba(167,139,250,0.4);"></div>
            <div class="step-dot active"></div>
            <div class="flex-1 h-px" style="background: rgba(255,255,255,0.1);"></div>
            <div class="step-dot"></div>
        </div>

        <div class="mb-6">
            <h2 class="text-white font-bold text-lg mb-1">Créer le compte administrateur</h2>
            <p class="text-purple-300/70 text-xs leading-relaxed">
                Cette page est accessible une seule fois. Elle disparaît dès qu'un compte est créé.
            </p>
        </div>

        {{-- Flash erreur --}}
        @if($errors->any())
        <div class="flex items-start gap-3 bg-red-500/10 border border-red-400/20 text-red-300 rounded-2xl px-4 py-3 text-sm mb-5">
            <i class="fi fi-sr-exclamation text-red-400 flex-shrink-0 mt-0.5"></i>
            <ul class="space-y-0.5">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form method="POST" action="{{ route('setup.store') }}" class="space-y-4">
            @csrf

            {{-- Nom --}}
            <div class="field-wrap px-4 py-3">
                <label>Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       placeholder="Direction" required autocomplete="name">
            </div>

            {{-- Email --}}
            <div class="field-wrap px-4 py-3">
                <label>Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       placeholder="direction@gsvictoriakoa.ci" required autocomplete="email">
            </div>

            {{-- Mot de passe --}}
            <div class="field-wrap px-4 py-3">
                <label>Mot de passe <span style="color:rgba(255,255,255,0.3); font-weight:400; text-transform:none; letter-spacing:0;">(min. 8 caractères)</span></label>
                <input type="password" name="password" required autocomplete="new-password"
                       placeholder="••••••••••">
            </div>

            {{-- Confirmation --}}
            <div class="field-wrap px-4 py-3">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                       placeholder="••••••••••">
            </div>

            {{-- Avertissement --}}
            <div class="flex items-start gap-3 bg-amber-400/10 border border-amber-400/20 rounded-2xl px-4 py-3 mt-2">
                <i class="fi fi-sr-shield-check text-amber-400 text-sm flex-shrink-0 mt-0.5"></i>
                <p class="text-amber-300/80 text-xs leading-relaxed">
                    Notez bien vos identifiants — il n'y a pas de récupération de mot de passe automatique sur cet hébergement.
                </p>
            </div>

            <button type="submit"
                    class="w-full mt-2 flex items-center justify-center gap-2.5
                           bg-violet-600 hover:bg-violet-500 active:scale-[0.99]
                           text-white font-bold text-sm py-3.5 rounded-2xl
                           transition-all duration-200 shadow-lg shadow-violet-900/50">
                <i class="fi fi-sr-user-add text-sm"></i>
                Créer le compte et accéder à l'administration
            </button>
        </form>
    </div>

    {{-- Footer --}}
    <p class="text-center text-purple-400/40 text-xs mt-6">
        Cette page se désactive automatiquement après la création du premier compte.
    </p>

</div>

</body>
</html>
