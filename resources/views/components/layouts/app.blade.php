<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'CRUD Users - Laravel Livewire' }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="User Management System built with Laravel and Livewire">
    <meta name="author" content="Your Name">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter-sans:400,500,600" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-neutral-primary-soft min-h-screen">
    <!-- Global Flash Messages -->
    <x-alert />
    
    <!-- Main Content -->
    {{ $slot }}
</body>

</html>
