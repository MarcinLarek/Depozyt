@extends('frontend.layout.master-dashboard')
@section('content')
<h1 class="mt-md-4">Edytuj dane użytkownika</h1>
<hr />
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card  border-0">
      <div class="card-body">
        <h4 class="card-title">Edycja użytkownika</h4>
        <form id="register" action="{{ route('admin.users.update', ['id' => $user->id]) }}" method="post">
          @csrf
          @method('PATCH')
          <fieldset>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="username" class="control-label">Nazwa użytkownika</label>
                <input name="username" id="username" class="form-control" value="{{ old('username', $user->username) }}" placeholder="Nazwa użytkownika" />
                @error('username')
                {{ $message }}
                @enderror
              </div>
            </div>
            <h5>Jeśli nie chcesz zmieniać hasła, zostaw puste pola</h5>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="password" class="control-label">Hasło</label>
                <a class="alert-link" data-toggle="modal" href="#myModal">
                  <img class="ml-2" src="{{ asset('/images/info.svg') }}" title="Wymogi dotyczące hasła." />
                </a>
                <input name="password" id="password" type="password" class="form-control" placeholder="Hasło" />
              </div>
              <div class="form-group col-md-6">
                <label for="compare-password" class="control-label">Potwierdź hasło</label>
                <input name="compare-password" id="compare-password" type="password" class="form-control" placeholder="Potwierdź hasło" />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="email" class="control-label">Email</label>
                <input name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="Email" />
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="client_type" class="control-label">Typ Konta</label>
                <select name="client_type_id" id="client_type" class="custom-select">
                  @foreach(\App\Models\ClientType::all() as $clientType)
                  <option value="{{ $clientType->getId() }}">{{ $clientType->getName() }}</option>
                  @endforeach
                </select>
                @error('client_type_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="country" class="control-label">Państwo</label>
                <select name="country_id" id="country" class="custom-select">
                  @foreach(\App\Models\Country::all() as $country)
                  <option value="{{ $country->getId() }}">Państwo</option>
                  @endforeach
                </select>
                @error('country')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <a href="{{ route('admin.users.delete', ['id' => $user->id]) }}"><button type="button" class="btn btn-danger" name="button">Usuń użytkownika</button></a>
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="Zapisz zmiany" class="btn btn-primary" />
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mb-md-2">
              <div id="progressBar" class="progress d-none">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span id="progressText"></span></div>
              </div>
            </div>
            <div class="col-md-12 mt-md-2">
              <div id="successAlert" class="alert alert-success d-none">
                <strong>UDAŁO SIĘ!</strong> Twoje dane zostały zapisane.<br /><strong>Sprawdź
                  skrzynkę pocztową z linkiem aktywacyjnym.</strong>
              </div>
            </div>
            <div class="col-md-12 mt-md-2">
              <div id="invalidAlert" class="alert alert-danger d-none">
                <strong>UPS... Coś poszło nie tak!</strong> Twoje dane nie zostały zapisane.
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Uwagi dotyczące hasła</h5>
        <button class="close" aria-label="Close" type="button" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Hasło musi składać się przynajmniej z jednego znaku specjalnego, wielkich lub małych liter oraz
          cyfr.</p>
      </div>
    </div>
  </div>
</div>
@endsection
