<nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark px-0 mx-0">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse d-sm-inline-flex mt-auto">
      <ul class="navbar-nav flex-grow-1">
        <li class="nav-item ml-4">
          <a class="nav-link text-center" href="{{ route('home') }}"> {{ __('navbar.main') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-center" asp-area="" href="{{ route('what-is-depozyt') }}"> {{ __('navbar.whatisdeposit') }}</a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link text-center" asp-area="" href="{{ route('regulations') }}" asp-controller="Home" asp-action="Privacy">{{ __('navbar.statute') }}</a>
        </li>
        <li class="nav-item ml-3">
          <a class="nav-link text-center" asp-area="" href="{{ route('contact') }}" asp-controller="Home" asp-action="Contact">{{ __('navbar.contact') }}</a>
        </li>
      </ul>
      <ul class="navbar-nav flex-grow-1 ml-md-auto">
        <li class="nav-item dropdown ml-md-auto">
          <a class="nav-link dropdown-toggle" role="button" aria-expanded="false" aria-haspopup="true" href="#" data-toggle="dropdown">{{ __('navbar.language') }}</a>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" value="en" href="{{ route('changeLang', 'en', ['lan' => 'en']) }}">{{ __('navbar.eng') }}</a>
            <a class="dropdown-item" value="pl" href="{{ route('changeLang', 'pl', ['lan' => 'pl']) }}">{{ __('navbar.pol') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
