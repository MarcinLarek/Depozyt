@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Stwórz nową wpłatę/wypłatę</h1>
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
    <div class="col-md-12 mt-md-2">
        <div id="invalidAlert" class="alert alert-danger d-none">
            @error('name')
            {{ $message }}
            @enderror
            @error('symbol')
            {{ $message }}
            @enderror
        </div>
    </div>
    <form method="post" action="{{ route('admin.payments.store') }}" class="w-50 mx-auto">
        @csrf

        <div class="row">
          <div class="form-group col-md-6">
              <label for="user_id" class="control-label">Użytkownik</label>
              <select name="user_id" class="custom-select">
                @foreach($users as $user)
                  @if( $user['client_type_id'] === 1)
                    <option value="{{ $user['id'] }}">{{$user['username']}}</option>
                  @endif
                @endforeach
              </select>
          </div>
          <div class="form-group col-md-6">
              <label for="bank_name" class="control-label">Nazwa Banku</label>
              <select name="bank_name" class="custom-select">
                @foreach($banks as $bank)
                    <option>{{ $bank->bank_name }}</option>
                @endforeach
              </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-4">
              <label for="currency_id" class="control-label">Waluta </label>
              <select name="currency_id" class="custom-select">
                @foreach($currencies as $currency)
                    <option value="{{ $currency->id}}">{{ $currency->symbol }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-md-4">
              <label for="amount" class="control-label">Kwota</label>
              <input name="amount" id="amount" class="form-control" value="{{ old('amount') }}" placeholder="Kwota"/>
              <span asp-validation-for="amount" class="text-danger"></span>
          </div>
          <div class="form-group col-md-4">
              <label for="document_id" class="control-label">Id dokumentu (Domyślnie 0)</label>
              <input name="document_id" id="document_id" class="form-control" value="{{ old('document_id') }}" placeholder="Id dokumentu"/>
              <span asp-validation-for="document_id" class="text-danger"></span>
          </div>
        </div>
        <div class="row py-3">
          <input type="submit" class="btn btn-primary mx-auto" value="Stwórz wpłate/wypłate"/>
        </div>
    </form>
@endsection
