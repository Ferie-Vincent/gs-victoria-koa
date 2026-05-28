@extends('layouts.app')

@php $annee = \App\Models\Setting::schoolYear(); @endphp
@section('title', 'Accueil')
@section('seo_title', 'Groupe Scolaire VICTORIA-KOA — École Maternelle & Primaire à Abidjan')
@section('meta_description', 'École maternelle et primaire au cœur d\'Angré 9ème Tranche, Abidjan. Niveaux TPS à CM2, encadrement bienveillant, inscriptions ' . $annee . ' ouvertes. Un deuxième foyer pour votre enfant.')
@section('meta_keywords', 'école maternelle Abidjan, école primaire Angré, meilleure école Abidjan, inscription scolaire ' . date('Y') . ', VICTORIA-KOA, TPS PS GS CP CE CM, Côte d\'Ivoire')
@section('canonical', url('/'))

@section('content')

    {{-- 1. Hero --}}
    @include('home.hero')

    {{-- 2. Mot de Bienvenue --}}
    @include('home.welcome')

    {{-- 3. Nos Valeurs --}}
    @include('home.values')

    {{-- 4. Nos Activités --}}
    @include('home.activities')

    {{-- 5. CTA Inscription --}}
    @include('home.enrollment-cta')

    {{-- 6. Nos Chiffres --}}
    @include('home.stats')

    {{-- 7. Aperçu Classes --}}
    @include('home.classes-preview')

    {{-- 8. Comment s'inscrire --}}
    @include('home.how-to-enroll')

    {{-- 9. Témoignages --}}
    @include('home.testimonials')

    {{-- 10. Actualités Récentes --}}
    @include('home.recent-news')

    {{-- 11. Mini Formulaire Contact --}}
    @include('home.contact-form')

@endsection
