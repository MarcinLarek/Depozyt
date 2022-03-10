<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('navbar.title') }}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body>
  <header>
    <div class="container ml-md-5 mb-2 mt-2">
      <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo-napis.png') }}" id="logo" alt="logo" />
      </a>
      <div class="float-md-right">
        <div class="mt-4 row">
          @guest()
          <div class="col-md-3 text-right">
            <i class="fa fa-user-circle fa-4x" style="color: #1b1464"></i>
          </div>
          <div class="col-md-9 row">
            <h3 class="main-color">
              <a href="{{ route('sign-in') }}">
                {{ __('navbar.login') }}
              </a>
            </h3>
            <span>
              {{ __('navbar.dontaccount') }} <a href="{{ route('register') }}">{{ __('navbar.registeryourself') }}</a>
            </span>
          </div>
          @endguest
        </div>
      </div>
    </div>
    @guest()
    @include('frontend.layout.navbar.public')
    @endguest
    @auth()
    @include('frontend.layout.navbar.client')
    @include('frontend.layout.navbar.data')
    @endauth
  </header>
  <div class="container-fluid">
    <main role="main" class="pb-3">
      @yield('content')
    </main>
  </div>
  <footer class="footer text-white">
    <div class="container">
      &copy; 2019 - {{ date('Y') }} - {{ config('app.name') }}
    </div>
  </footer>
  <script src="{{ asset('/js/app.js') }}"></script>
  @yield("scripts")
</body>

</html>
