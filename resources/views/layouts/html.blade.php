<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Mito</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('vendor/mito/css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('vendor/mito/js/app.js') }}" defer></script>

        <livewire:styles />
    </head>
    <body>
        {{ $slot }}

        @livewire('livewire-ui-modal')
        <livewire:scripts />
    </body>
</html>
