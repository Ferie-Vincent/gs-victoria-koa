<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Administration GS Victoria-Koa</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo/logo-2-2.png') }}">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-rounded/css/uicons-solid-rounded.css">
    <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css">
    @vite('resources/css/app.css')
    <style>
        body { background: #1E1B4B; }
        .login-panel {
            animation: slideUp 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .field-wrap {
            position: relative;
            background: #F8F7FF;
            border: 1.5px solid #E8E4FF;
            border-radius: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .field-wrap:focus-within {
            border-color: #7C3AED;
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
        }
        .field-wrap input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            padding: 12px 16px 12px 44px;
            font-size: 0.9rem;
            color: #1E1B4B;
            font-weight: 500;
        }
        .field-wrap input::placeholder { color: #B0A8D0; font-weight: 400; }
        .field-wrap .field-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9B8EC0;
            font-size: 1rem;
        }
    </style>
</head>
<body class="min-h-screen flex">

    {{-- Panneau gauche — déco --}}
    <div class="hidden lg:flex flex-col justify-between w-2/5 p-12 relative overflow-hidden"
         style="background: linear-gradient(160deg, #312E81 0%, #1E1B4B 100%);">

        {{-- Photo école en fond --}}
        <div class="absolute inset-0" style="z-index: 0;">
            <img src="{{ asset('images/hero/20260128_113736-1-scaled-e1771086502923-995x1024.jpg') }}"
                 alt="" class="w-full h-full object-cover object-center"
                 style="opacity: 0.18; mix-blend-mode: luminosity;">
        </div>

        {{-- Pattern (au-dessus de la photo) --}}
        <div class="absolute inset-0 opacity-10"
             style="z-index:1; background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 28px 28px;"></div>

        {{-- Blob --}}
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full opacity-20"
             style="z-index:1; background: radial-gradient(circle, #7C3AED, transparent 70%);"></div>
        <div class="absolute top-20 right-0 w-64 h-64 rounded-full opacity-10"
             style="z-index:1; background: radial-gradient(circle, #A78BFA, transparent 70%);"></div>

        <div class="relative z-10">
            <div class="w-12 h-12 rounded-2xl bg-white/10 ring-1 ring-white/20 flex items-center justify-center mb-6">
                <img src="{{ asset('images/logo/logo-2-2.png') }}" alt="Logo" class="w-8 h-8 object-contain">
            </div>
            <h1 class="text-white font-bold text-2xl leading-tight mb-2">Groupe Scolaire<br>Victoria-Koa</h1>
            <p class="text-purple-300 text-sm">Espace d'administration sécurisé</p>
        </div>

        <div class="relative z-10 space-y-4">
            @foreach([
                ['icon' => 'fi-sr-newspaper',   'text' => 'Gérez les actualités'],
                ['icon' => 'fi-sr-comment-alt', 'text' => 'Modérez les témoignages'],
                ['icon' => 'fi-sr-envelope',    'text' => 'Consultez les messages'],
                ['icon' => 'fi-sr-settings',    'text' => 'Configurez le site'],
            ] as $item)
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center flex-shrink-0">
                    <i class="fi {{ $item['icon'] }} text-purple-300 text-sm"></i>
                </div>
                <p class="text-purple-200 text-sm">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>

        <p class="relative z-10 text-purple-400/60 text-xs">
            © {{ date('Y') }} GS Victoria-Koa · Angré 9ème Tranche, Abidjan
        </p>
    </div>

    {{-- Panneau droit — formulaire --}}
    <div class="flex-1 flex items-center justify-center p-6 lg:p-12"
         style="background: #F3F4F8;">

        <div class="login-panel w-full max-w-md">

            {{-- Header mobile --}}
            <div class="lg:hidden text-center mb-8">
                <img src="{{ asset('images/logo/logo-2-2.png') }}" alt="Logo"
                     class="w-16 h-16 rounded-2xl mx-auto mb-3 shadow-lg object-contain" style="background:#1E1B4B; padding:6px;">
                <h1 class="text-gray-800 font-bold text-xl">GS Victoria-Koa</h1>
                <p class="text-gray-400 text-sm">Espace administration</p>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="mb-7">
                    <h2 class="text-gray-900 font-bold text-xl mb-1">Connexion</h2>
                    <p class="text-gray-400 text-sm">Accès réservé à l'équipe de direction</p>
                </div>

                @if($errors->any())
                <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 text-sm mb-6">
                    <i class="fi fi-sr-exclamation text-red-400 flex-shrink-0 mt-0.5"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                            Adresse email
                        </label>
                        <div class="field-wrap">
                            <i class="fi fi-sr-envelope field-icon"></i>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   required autofocus autocomplete="email"
                                   placeholder="direction@gsvictoriakoa.ci">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">
                            Mot de passe
                        </label>
                        <div class="field-wrap">
                            <i class="fi fi-sr-lock field-icon"></i>
                            <input type="password" name="password"
                                   required autocomplete="current-password"
                                   placeholder="••••••••••">
                        </div>
                    </div>

                    <div class="flex items-center gap-2 pt-1">
                        <input type="checkbox" name="remember" id="remember"
                               class="w-4 h-4 rounded text-violet-600 border-gray-300 cursor-pointer">
                        <label for="remember" class="text-sm text-gray-500 cursor-pointer select-none">
                            Se souvenir de moi
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-violet-600 hover:bg-violet-700
                                   text-white font-semibold py-3 rounded-xl text-sm transition-all duration-200
                                   hover:scale-[1.01] shadow-md shadow-violet-200 mt-2">
                        <i class="fi fi-sr-sign-in-alt text-sm"></i>
                        Se connecter
                    </button>
                </form>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('home') }}"
                   class="text-gray-400 hover:text-gray-600 text-xs transition-colors inline-flex items-center gap-1.5">
                    <i class="fi fi-rr-arrow-left text-xs"></i>
                    Retour au site public
                </a>
            </div>
        </div>
    </div>

</body>
</html>
