@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Edytuj Bank - <strong>{{ $bank['name']}}</strong></h1>
    <hr/>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="{{ route('admin.bankaccounts.update', ['id' => $bank->id]) }}" class="w-50 mx-auto">
        @csrf
        @method('PUT')
            <fieldset>
                <div class="row">
                  <div class="form-group col-md-6">
                      <label for="user_username" class="control-label">Użytkownik </label>
                      <select name="user_username" class="custom-select">
                        @foreach($users as $user)
                            <option>{{$user['username']}}</option>
                        @endforeach
                      </select>
                  </div>

                </div>
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="name"
                               class="control-label">Nazwa</label>
                        <input name="name" id="name" class="form-control"
                               value="{{ old('name', $bank['name']) }}"/>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="bank_name"
                               class="control-label">Nazwa Banku</label>
                        <input name="bank_name" id="bank_name" class="form-control"
                               value="{{ old('bank_name', $bank['bank_name']) }}"/>
                    </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                      <label for="currency_name" class="control-label">Waluta </label>
                      <select name="currency_name" class="custom-select">
                        @foreach($currencies as $currency)
                            <option>{{ $currency->symbol }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group col-md-4">
                      <label for="currency_name" class="control-label">Kraj </label>
                      <select name="country_name" class="custom-select">
                        @foreach($countries as $country)
                            <option>{{ $country->country_name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                      <label for="account_number"
                             class="control-label">Numer konta</label>
                      <input name="account_number" id="account_number" class="form-control"
                             value="{{ old('account_number', $bank['account_number']) }}"/>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                      <label for="swift"
                             class="control-label">Swift</label>
                      <input name="swift" id="swift" class="form-control"
                             value="{{ old('swift', $bank['swift']) }}"/>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-4">
                      <label for="active" class="control-label">Aktywne </label>
                      <select name="active" class="custom-select">
                            <option value="1">Tak</option>
                            <option value="0">Nie</option>
                      </select>
                  </div>
                </div>
                <div class="form-group col-md-12 text-center mt-md-4">
                    <input type="submit" value="Zapisz" class="btn btn-primary"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-md-2">
                    <div id="progressBar" class="progress d-none">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                             role="progressbar" aria-valuenow="100" aria-valuemin="0"
                             aria-valuemax="100" style="width: 100%"><span
                                id="progressText"></span></div>
                    </div>
                </div>
                <div class="col-md-12 mt-md-2">
                    <div id="successAlert" class="alert alert-success d-none">
                        <strong>UDAŁO SIĘ!</strong> Twoje dane zostały zapisane.<br/><strong>Sprawdź
                            skrzynkę pocztową z wiadomością potwierdzającą zawarcie usługi
                            depozytowej.</strong>
                    </div>
                </div>
                <div class="col-md-12 mt-md-2">
                    <div id="invalidAlert" class="alert alert-danger d-none">
                        <strong>UPS... Coś poszło nie tak!</strong> Twoje dane nie zostały
                        zapisane.
                    </div>
                </div>
            </div>

    </form>
@endsection
