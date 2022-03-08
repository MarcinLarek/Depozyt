<nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-dark bg-white px-0 mx-0 py-0 my-0">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse"
                aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse d-sm-inline-flex mt-auto">
            <ul class="navbar-nav flex-grow-1">
                <li class="nav-item ml-4">
                    <a class="nav-link text-center" href="{{ route('admin') }}">Główna</a>
                </li>
            </ul>
            <ul class="navbar-nav flex-grow-1 ml-md-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.countries') }}">Kraje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.currencies') }}">Waluty</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.client-types') }}">Typy klientów</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" aria-expanded="false" aria-haspopup="true"
                       href="#" data-toggle="dropdown">Użytkownicy</a>
                    <div class="dropdown-menu"
                         style="left: 0; top: 0; position: absolute; transform: translate3d(0px, 38px, 0px);"
                         x-placement="bottom-start">
                        <a class="dropdown-item" href="{{ route('admin.users') }}">Klienci</a>
                        <a class="dropdown-item" href="{{ route('admin.admins') }}">Administratorzy</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" aria-expanded="false" aria-haspopup="true"
                       href="#" data-toggle="dropdown">Platforma</a>
                    <div class="dropdown-menu"
                         style="left: 0; top: 0; position: absolute; transform: translate3d(0px, 38px, 0px);"
                         x-placement="bottom-start">
                        <a class="dropdown-item" href="{{ route('admin.platform-data') }}">Dane platformy</a>
                        <a class="dropdown-item" href="{{ route('admin.platform-bank-account') }}">Konta bankowe</a>
                          <a class="dropdown-item" href="{{ route('admin.contact') }}">Wiadomości</a>
                    </div>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link" href="{{ route('admin.adminlogout') }}">Wyloguj</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
