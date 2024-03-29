<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    @yield('styles')
    <script src="{{ asset('js/main.js') }}" defer></script>
    @yield('scripts')
</head>

<body>
    @include('components.pages.main.header')
    <div id="main-content">
        @include('components.pages.main.nav')
        @yield('content')
    </div>
    @include('components.pages.main.footer')
    @include('components.pages.main.subHeader')
    <div id = "followInfo" data-pusher="{{ env('PUSHER_APP_KEY') }}" data-user="{{ Auth::user()->id ?? null }}"
         data-route-notification="{{ route('update.readNotification') }}" data-text-notification="{{ __('User') }}"
         data-content-notification="{{ __('followed you') }}"></div>
</body>

</html>
