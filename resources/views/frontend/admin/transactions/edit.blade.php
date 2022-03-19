@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Edytuj tranzakcje - <strong>{{ $transaction['name']}}</strong></h1>
<hr />
<form method="post" action="{{ route('admin.transactions.update', ['id' => $transaction->id]) }}" class="w-50 mx-auto">
  @csrf
  @method('PUT')

  <form id="Create" action="{{ route('admin.transactions.store', ['id' => $transaction->id]) }}" asp-controller="Transaction" method="post">
    @csrf
    <fieldset>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="customer_id" class="control-label">Zleceniodawca </label>
          <select name="customer_id" class="custom-select">
            @foreach($users as $user)
            <option>{{$user['username']}}</option>
            @endforeach
          </select>
          @error('customer_id')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="contractor_id" class="control-label">Wykonawca </label>
          <select name="contractor_id" class="custom-select">
            @foreach($users as $user)
            <option>{{$user['username']}}</option>
            @endforeach
          </select>
          @error('contractor_id')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="row">

        <div class="form-group col-md-6">
          <label for="name" class="control-label">Nazwa tranzakcji</label>
          <input name="name" id="name" class="form-control" value="{{ old('name', $transaction['name']) }}" />
          @error('name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="transaction_type">Typ tranzakcji</label>
          <select id="transaction_type" name="transaction_type" class="custom-select">
            <option value="1">Usługi kontraktowe</option>
            <option value="2">Towary ogólne</option>
            <option value="3">Pośrednictwo</option>
          </select>
          @error('transaction_type')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="from_date" class="control-label">Od:</label>
          <input name="from_date" class="form-control" value="{{$transaction['from_date']}}" type="date" />
          @error('from_date')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="to_date" class="control-label">Do:</label>
          <input name="to_date" class="form-control" value="{{$transaction['to_date']}}" type="date" />
          @error('to_date')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="commission_payer">Płacący: </label>
          <select name="commission_payer" class="custom-select">
            <option value="principal">Zleceniodawca</option>
            <option value="contractor">Wykonawca</option>
            <option value="half">Pół na poł</option>
          </select>
          @error('commission_payer')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4">
          <label for="bank_name" class="control-label">Nazwa Banku</label>
          <select name="bank_name" class="custom-select">
            @foreach($banks as $bank)
            <option>{{ $bank->bank_name }}</option>
            @endforeach
          </select>
          @error('bank_name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group col-md-4">
          <label for="currency_name" class="control-label">Waluta </label>
          <select name="currency_name" class="custom-select">
            @foreach($currencies as $currency)
            <option>{{ $currency->symbol }}</option>
            @endforeach
          </select>
          @error('currency_name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group col-md-4">
          <label for="amount" class="control-label">Kwota</label>
          <input name="amount" id="amount" class="form-control" value="{{ old('amount', $transaction['amount']) }}" />
          @error('amount')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group col-md-4">
          <label for="payment" class="control-label">Zapłacono</label>
          <input name="payment" id="payment" class="form-control" value="{{ old('payment', $transaction['payment']) }}" />
          @error('payment')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-12">
          <label for="description" class="control-label">Opis</label>
          <textarea asp-for="description" class="form-control" name="description" placeholder="Opis" cols="80" rows="3">{{ old('description', $transaction['description']) }}</textarea>
          @error('description')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
    </fieldset>
    <div class="row">
      <div class="form-group col-md-12 text-center mt-md-4">
        <input type="submit" value="Zapisz" class="btn btn-primary" />
      </div>
    </div>
  </form>

</form>
@endsection
