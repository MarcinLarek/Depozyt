<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Twoje bezpieczne zakupy - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
</head>
<body>
<header>
    @auth()
        @include('frontend.layout.navbar.admin')
    @endauth
</header>
<div class="container-fluid">
    <main role="main" class="pb-3">
        @yield('content')
    </main>
</div>
@auth()
    <footer class="footer text-white">
        <div class="container">
            &copy; 2019 - {{ date('Y') }} - {{ config('app.name') }}
        </div>
    </footer>
@endauth
<script src="{{ asset('/js/app.js') }}"></script>
@yield("scripts")
</body>
</html>
