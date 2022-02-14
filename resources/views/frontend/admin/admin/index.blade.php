@extends('frontend.layout.master-dashboard')

@section('content')
    <div class="row col-md-8 mx-auto mt-4">
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <a href="{{ route('admin.users') }}"><i class="fas fa-user-circle fa-4x"></i></a>
                </div>
                <div class="card-title">
                    <a href="{{ route('admin.users') }}">Użytkownicy ({{ \App\Models\User::count() }})</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <a href="{{ route('admin.admins') }}"><i class="fas fa-user fa-4x"></i></a>
                </div>
                <div class="card-title">
                    <a href="{{ route('admin.admins') }}">Administratorzy ({{ \App\Models\Admin::count() }})</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <a href="{{ route('admin.countries') }}"><i class="fa fa-flag fa-4x"></i></a>
                </div>
                <div class="card-title">
                    <a href="{{ route('admin.countries') }}">Kraje ({{ \App\Models\Country::count() }})</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow">
                <div class="card-body">
                    <a href="{{ route('admin.client-types') }}"><i class="fa fa-building fa-4x"></i></a>
                </div>
                <div class="card-title">
                    <a href="{{ route('admin.client-types') }}">Typ klienta ({{ \App\Models\ClientType::count() }})</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <a href="{{ route('admin.bankaccounts') }}"><i class="fas fa-university fa-4x"></i></a>
                </div>
                <div class="card-title">
                    <a href="{{ route('admin.bankaccounts') }}">Konta bankowe ({{ \App\Models\ClientBankAccount::count() }})</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <a href="{{ route('admin.transactions') }}"><i class="fa fa-file fa-4x"></i></a>
                </div>
                <div class="card-title">
                    <a href="{{ route('admin.transactions') }}">Transakcje ({{ \App\Models\ClientBankAccount::count() }})</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <a href="{{ route('admin.payments') }}"><i class="fas fa-arrow-circle-right fa-4x"></i></a>
                </div>
                <div class="card-title">
                    <a href="{{ route('admin.payments') }}">Wpłaty na platformę ({{ \App\Models\WalletHistory::count() }})</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <a href="withdrawal"><i class="fas fa-arrow-circle-left fa-4x"></i></a>
                </div>
                <div class="card-title">
                    <a href="{{ route('admin.withdrawal') }}">Wypłaty z platformy ({{ \App\Models\ClientBankAccount::count() }})</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <a href="{{ route('admin.errors') }}"><i class="fa fa-flag fa-4x"></i></a>
                </div>
                <div class="card-title">
                    <a href="{{ route('admin.errors') }}">Zgłoszone Wyjątki ({{ \App\Models\PlatformException::count() }})</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row col-md-8 mx-auto mt-5">
        <div class="col-12 col-md-6">
            <div class="card shadow">
                <h2 class="card-title text-center my-1">Importuj plik <strong>.csv</strong> z wpłatami</h2>
                <div class="card-body">
                    <form action="{{ route('admin.csvimport') }}" method="post" enctype="multipart/form-data">
                      @csrf
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="import" name="import" required>
                            <label class="custom-file-label" for="customInput">Importuj wpłaty...</label>
                        </div>
                        <div class="form-group text-center mt-5 mb-3">
                            <input type="submit" class="btn btn-primary " value="Importuj">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card shadow">
                <h2 class="card-title text-center my-1">Exportuj plik <strong>.csv</strong> z wpłatami</h2>
                <div class="card-body">
                    <form action="{{ route('admin.csvexport') }}" method="post" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group text-center  mb-3">
                          <span data-href="{{ route('admin.csvexport') }}" id="export" class="btn btn-primary" onclick="exportTasks(event.target);">
                            Exportuj
                          </span>
                        </div>
                        <script>
                           function exportTasks(_this) {
                              let _url = $(_this).data('href');
                              window.location.href = _url;
                           }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
