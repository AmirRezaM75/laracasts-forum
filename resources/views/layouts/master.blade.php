<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="The most popular PHP and Laravel forum.">
    <!-- TODO: https://css-tricks.com/essential-meta-tags-social-media/ -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chatter Web Development Forum</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script>
        window.App = {!! json_encode(['user' => auth()->user()]) !!}
    </script>
    @stack('styles')
</head>
@php
    $fluidSection = isset($fluidSection) ? $fluidSection : false;
@endphp
<body class="antialiased">
    <div id="app" class="xl:flex bg-white">
        <div class="xl:flex-1">
            @include('partials.navbar')
            <div class="wrapper">
                <div class="{{ $fluidSection ? '' : 'section' }}">
                    <div class="forum-wrapper">
                        @yield('content')
                    </div>
                </div>

                <auth-modal></auth-modal>

                @auth
                    <conversation-modal></conversation-modal>

                    <account-slideout-menu></account-slideout-menu>
                @endauth

                <flash message="{{ session('flash') }}"></flash>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
