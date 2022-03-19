@extends('frontend.layout.master-dashboard')

@section('content')
@if($payment['amount'] >=0)
<h1>Edytuj wpłate ID:<strong>{{ $payment->id }}</strong></h1>
@else
<h1>Edytuj wypłate ID:<strong>{{ $payment->id }}</strong></h1>
@endif
<hr />
<form method="post" action="{{ route('admin.payments.update', ['id' => $payment->id]) }}" class="w-50 mx-auto">
  @csrf
  @method('PUT')

  <div class="row">
    <div class="form-group col-md-6">
      <label for="user_id" class="control-label">Użytkownik </label>
      <select name="user_id" class="custom-select">
        @foreach($users as $user)
        <option>{{$user['username']}}</option>
        @endforeach
      </select>
      @error('user_id')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group col-md-6">
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
  </div>

  <div class="row">
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
      <input name="amount" id="amount" class="form-control" value="{{ old('amount', $payment['amount']) }}" />
      @error('currency_name')
      <span class="amount">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="document_id" class="control-label">Id dokumentu</label>
      <input name="document_id" id="document_id" class="form-control" value="{{ old('document_id', $payment['generated_document_id']) }}" />
      @error('document_id')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="row py-3">
    @if($payment['amount'] >=0)
    <input type="submit" class="btn btn-primary mx-auto" value="Edytuj wpłate" />
    @else
    <input type="submit" class="btn btn-primary mx-auto" value="Edytuj wypłate" />
    @endif
  </div>
</form>
@endsection
