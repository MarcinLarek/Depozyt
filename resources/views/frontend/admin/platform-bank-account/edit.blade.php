@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Edytuj konto bankowe - <strong>{{ $bankAccount->bank_name }} - {{ $bankAccount->currency->getName() }}</strong></h1>
<hr />
<div class="col-md-6 mx-auto">
  <form method="post" action="{{ route('admin.platform-bank-account.update', ['id' => $bankAccount->id]) }}">
    @csrf
    @method('PUT')
    <div class="form-group col-md-8 mx-auto">
      <label for="account-number">Numer konta</label>
      <input type="text" name="account_number" id="account-number" class="form-control" placeholder="Numer konta" value="{{ old('account_number', $bankAccount->account_number) }}">
      @error('account_number')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group col-md-8 mx-auto">
      <label for="bank_name">Nazwa banku</label>
      <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Nazwa banku" value="{{ old('bank_name', $bankAccount->bank_name) }}">
      @error('bank_name')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group col-md-8 mx-auto">
      <label for="currency-id" class="control-label">Waluta</label>
      <select name="currency_id" id="currency-id" class="custom-select">
        <option value="">{{ __('bank-account.select-currency') }}</option>
        @foreach(\App\Models\Currency::getActiveCurrency() as $currency)
        <option value="{{ $currency->id }}" @if($bankAccount->currency_id == $currency->id) selected @endif>{{ $currency->symbol }} - {{ $currency->name }}</option>
        @endforeach
      </select>
      @error('currency_id')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group col-md-8 mx-auto">
      <label for="active" class="control-label">Czy aktywne</label>
      <select name="active" id="active" class="custom-select">
        <option value="1" @if ($bankAccount->isActive()) selected @endif>Tak</option>
        <option value="0" @if (!$bankAccount->isActive()) selected @endif>Nie</option>
      </select>
      @error('active')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="row py-3">
      <input type="submit" class="btn btn-primary mx-auto" value="Edytuj konto bankowe" />
    </div>
  </form>
</div>
@endsection
