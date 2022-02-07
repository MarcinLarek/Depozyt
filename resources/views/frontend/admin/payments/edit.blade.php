@extends('frontend.layout.master-dashboard')

@section('content')
    @if($payment['amount'] >=0)
    <h1>Edytuj wpłate ID:<strong>{{ $payment->id }}</strong></h1>
    @else
    <h1>Edytuj wypłate ID:<strong>{{ $payment->id }}</strong></h1>
    @endif
    <hr/>
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
    <form method="post" action="{{ route('admin.payments.update', ['id' => $payment->id]) }}" class="w-50 mx-auto">
        @csrf
        @method('PUT')

        <div class="row">
          <div class="form-group col-md-6">
              <label for="user_id" class="control-label">Użytkownik </label>
              <select name="user_id" class="custom-select">
                @foreach($users as $user)
                  @if( $user['client_type_id'] === 1)
                    <option>{{$user['username']}}</option>
                  @endif
                @endforeach
              </select>
          </div>
          <div class="form-group col-md-6">
              <label for="BankName" class="control-label">Nazwa Banku</label>
              <select name="BankName" class="custom-select">
                @foreach($banks as $bank)
                    <option>{{ $bank->bank_name }}</option>
                @endforeach
              </select>
          </div>
        </div>

        <div class="row">
          <div class="form-group col-md-4">
              <label for="CurrencyName" class="control-label">Waluta </label>
              <select name="CurrencyName" class="custom-select">
                @foreach($currencies as $currency)
                    <option>{{ $currency->symbol }}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group col-md-4">
              <label for="Amount" class="control-label">Kwota</label>
              <input name="Amount" class="form-control" value="{{$payment['amount']}}"/>
              <span asp-validation-for="Amount" class="text-danger"></span>
          </div>
          <div class="form-group col-md-4">
              <label for="DocumentID" class="control-label">Id dokumentu</label>
              <input name="DocumentID" class="form-control" value="{{$payment['generated_document_id']}}"/>
              <span asp-validation-for="Amount" class="text-danger"></span>
          </div>
        </div>
        <div class="row py-3">
          @if($payment['amount'] >=0)
            <input type="submit" class="btn btn-primary mx-auto" value="Edytuj wpłate"/>
          @else
            <input type="submit" class="btn btn-primary mx-auto" value="Edytuj wypłate"/>
          @endif
        </div>
    </form>
@endsection
