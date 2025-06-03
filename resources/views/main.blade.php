@extends('layout')

@section('content')
    <main class="main">
        <!-- Hero Section -->
        @include('components.hero')
        <!-- About Section -->
        @include('components.about')
        <!-- Stats Section -->
        @include('components.stats')
        <!-- Program Section -->
        @include('components.program')
        <!-- Clients Section -->
        @include('components.clients')
        <!-- Visi & Misi Section -->
        @include('components.visi-misi')
        <!-- Program & Keunggulan Section -->
        @include('components.keunggulan')
        <!-- Testimonials Section -->
        @include('components.testimonials')
        <!-- Ekstrakulikuler Section -->
        @include('components.ekstrakulikuler')
        <!-- Team Section -->
        @include('components.team')
        <!-- Contact Section -->
        @include('components.contact')
    </main>
@endsection
