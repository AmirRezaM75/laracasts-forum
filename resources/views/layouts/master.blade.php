<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="The most popular PHP and Laravel forum.">
    <!-- TODO: https://css-tricks.com/essential-meta-tags-social-media/ -->
    <!-- TODO: CSRF Token -->
    <title>Chatter Web Development Forum</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&amp;display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
<body class="antialiased">
<div class="xl:flex bg-white">
    <div class="xl:flex-1">
        @include('partials.navbar')
        <div class="wrapper">
            <div class="section">
                <div class="forum-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
