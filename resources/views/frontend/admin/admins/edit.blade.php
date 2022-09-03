@extends('frontend.layout.master-dashboard')
@section('content')
<h1 class="mt-md-4">Edytuj dane administratora</h1>
<hr />
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card  border-0">
      <div class="card-body">
        <h4 class="card-title">Edycja administratora</h4>
        <form id="register" action="{{ route('admin.admins.update', ['id' => $admin->id]) }}" method="post">
          @csrf
          @method('PATCH')
          <fieldset>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="login" class="control-label">Login</label>
                <input name="login" id="login" class="form-control" value="{{ old('login', $admin->login) }}" placeholder="Login" />
                @error('login')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="name" class="control-label">Imie</label>
                <input name="name" id="name" class="form-control" value="{{ old('name', $admin->name) }}" placeholder="Imie" />
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="phone" class="control-label">Nr Telefonu</label>
                <input name="phone" id="phone" class="form-control" value="{{ old('phone', $admin->phone) }}" placeholder="Nr Telefonu" />
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="surname" class="control-label">Nazwisko</label>
                <input name="surname" id="surname" class="form-control" value="{{ old('surname', $admin->surname) }}" placeholder="Nazwisko" />
                @error('surname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="error_notification" class="control-label">Otrzymywać powiadomienia o błędach?</label>
                <select name="error_notification" id="error_notification" class="custom-select">
                  @if($admin->error_notification == 1)
                  <option value="1">Tak</option>
                  <option value="0">Nie</option>
                  @else
                  <option value="0">Nie</option>
                  <option value="1">Tak</option>
                  @endif
                </select>
                @error('error_notification')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="password" class="control-label">Hasło</label>
                <a class="alert-link" data-toggle="modal" href="#myModal">
                  <img class="ml-2" src="{{ asset('/images/info.svg') }}" title="Wymogi dotyczące hasła." />
                </a>
                <input name="password" id="password" type="password" class="form-control" placeholder="Hasło" value="{{ old('password') }}" />
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="compare-password" class="control-label">Potwierdź hasło</label>
                <input name="compare-password" id="compare-password" type="password" class="form-control" placeholder="Potwierdź hasło" value="{{ old('compare-password') }}" />
                @error('compare-password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="email" class="control-label">Email</label>
                <input name="email" id="email" value="{{ old('email', $admin->email) }}" class="form-control" placeholder="Email" />
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <a href="{{ route('admin.admins.delete', ['id' => $admin->id]) }}"><button type="button" class="btn btn-danger" name="button">Usuń administratora</button></a>
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
