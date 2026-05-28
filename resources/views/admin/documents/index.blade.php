@extends('layouts.admin')
@section('title', 'Documents PDF')
@section('page-title', 'Gestion des documents PDF')

@section('content')
<p class="text-gray-500 text-sm mb-8">
    Chaque document peut être remplacé en uploadant un nouveau PDF.
    Le fichier existant est écrasé automatiquement.
</p>

@foreach($catalogue as $groupKey => $group)
<div class="mb-8">
    <h2 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
        <span class="w-6 h-6 bg-purple-100 text-purple-700 rounded-lg flex items-center justify-center text-xs font-bold">📄</span>
        {{ $group['label'] }}
    </h2>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Document</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Statut</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Taille</th>
                    <th class="text-left px-5 py-3 font-semibold text-gray-600">Mis à jour</th>
                    <th class="px-5 py-3 font-semibold text-gray-600 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($group['items'] as $item)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-4">
                        <p class="font-medium text-gray-800">{{ $item['label'] }}</p>
                        <p class="text-gray-400 text-xs mt-0.5 font-mono">{{ $item['file'] }}</p>
                    </td>
                    <td class="px-5 py-4">
                        @if($item['exists'])
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                ✅ Présent
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-600">
                                ❌ Manquant
                            </span>
                        @endif
                    </td>
                    <td class="px-5 py-4 text-gray-500 text-xs">{{ $item['size'] ?? '—' }}</td>
                    <td class="px-5 py-4 text-gray-500 text-xs">{{ $item['updated'] ?? '—' }}</td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-3">
                            {{-- View current --}}
                            @if($item['exists'])
                            <a href="{{ $item['url'] }}" target="_blank"
                               class="text-blue-600 hover:text-blue-800 text-xs font-medium">
                                Voir
                            </a>
                            @endif

                            {{-- Upload form --}}
                            <form method="POST"
                                  action="{{ route('admin.documents.upload', $item['code']) }}"
                                  enctype="multipart/form-data"
                                  class="flex items-center gap-2">
                                @csrf
                                <label class="cursor-pointer">
                                    <input type="file" name="pdf" accept="application/pdf" required
                                           class="hidden"
                                           onchange="this.form.submit()"
                                           title="Choisir un PDF">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold
                                                 {{ $item['exists'] ? 'bg-gray-100 hover:bg-purple-100 text-gray-700 hover:text-purple-700' : 'bg-purple-600 hover:bg-purple-700 text-white' }}
                                                 cursor-pointer transition-colors border border-gray-200 {{ $item['exists'] ? '' : 'border-purple-600' }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                        {{ $item['exists'] ? 'Remplacer' : 'Uploader' }}
                                    </span>
                                </label>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach

<div class="bg-blue-50 border border-blue-200 rounded-2xl px-5 py-4 text-sm text-blue-800 flex items-start gap-3">
    <span class="flex-shrink-0 mt-0.5">ℹ️</span>
    <div>
        <strong>Upload automatique :</strong> dès que vous sélectionnez un PDF, il est envoyé immédiatement sans bouton de validation.
        Le fichier remplace l'ancienne version. Taille max : 10 Mo.
    </div>
</div>
@endsection
