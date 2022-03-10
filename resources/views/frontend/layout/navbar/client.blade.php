<nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-white px-0 mx-0">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse d-sm-inline-flex mt-auto">
      <ul class="navbar-nav flex-grow-1">
        <li class="nav-item ml-4">
          <a class="nav-link text-center" href="{{ route('home') }}" asp-area="" asp-controller="Home" asp-action="Index">{{ __('navbar.main') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-center" href="{{ route('what-is-depozyt') }}" asp-area="" asp-controller="Home" asp-action="WhatIsDepozyt"> {{ __('navbar.whatisdeposit') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-center" href="{{ route('regulations') }}" asp-area="" asp-controller="Home" asp-action="Privacy">{{ __('navbar.statute') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-center" asp-area="" href="{{ route('contact') }}" asp-controller="Home" asp-action="Contact">{{ __('navbar.contact') }}</a>
        </li>
      </ul>
      <ul class="navbar-nav flex-grow-1 ml-md-auto">
        <li class="nav-item dropdown ml-md-auto">
          <a class="nav-link dropdown-toggle" role="button" aria-expanded="false" aria-haspopup="true" href="#" data-toggle="dropdown">{{ __('navbar.resources') }}</a>
          <div class="dropdown-menu" style="left: 0; top: 0; position: absolute; transform: translate3d(0, 38px, 0);" x-placement="bottom-start">
            <a class="dropdown-item" href="{{ route('payment') }}">{{ __('navbar.balance') }}</a>
            <a class="dropdown-item" href="{{ route("withdrawal") }}">{{ __('navbar.withdrawal') }}</a>
            <a class="dropdown-item" href="{{ route('bank-accounts') }}">{{ __('navbar.bank') }}</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('transaction') }}">{{ __('navbar.services') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('recipients.payment') }}">{{ __('navbar.pay') }}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('recipients') }}">{{ __('navbar.contractors') }}</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" aria-expanded="false" aria-haspopup="true" href="#" data-toggle="dropdown">{{ __('navbar.settings') }}</a>
          <div class="dropdown-menu" style="left: 0px; top: 0px; position: absolute; transform: translate3d(0px, 38px, 0px);" x-placement="bottom-start">
            @if(Auth::user()->isCompany())
            <a class="dropdown-item" href="{{ route('representative') }}">{{ __('navbar.representative') }}</a>
            <a class="dropdown-item" href="{{ route('company-data') }}">{{ __('navbar.companydata') }}</a>
            @else
            <a class="dropdown-item" href="{{ route('client-data') }}">{{ __('navbar.mydata') }}</a>
            @endif
            <a class="dropdown-item" href="{{ route('client') }}">{{ __('navbar.myaccount') }}</a>
          </div>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="{{ route('logout') }}">{{ __('navbar.logout') }}</a>
        </li>
        <li class="nav-item dropdown">
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
