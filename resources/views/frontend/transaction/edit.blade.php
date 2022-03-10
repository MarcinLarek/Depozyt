@extends('frontend.layout.master')

@section('content')
<h1>{{ __('transaction.EDI-title') }}<strong>{{ $transaction['name']}}</strong></h1>
<hr />
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<form method="post" action="{{ route('transactions.update', ['id' => $transaction->id]) }}" class="w-50 mx-auto">
  @csrf
  <fieldset>
    <div class="row">
      <div class="form-group col-md-6">
        <h3>{{ __('transaction.EDI-contractor') }}: <b> {{$usercontractor['username']}} {{$usercontractordata['name']}} </b> </h3>
      </div>
      <div class="form-group col-md-6">
        <h2>{{ __('transaction.EDI-customer') }}: <b> {{$usercustomer['username']}} {{$usercustomerdata['name']}} {{$usercustomerdata['surname']}} </b></h2>
      </div>
    </div>
    <div class="row">

      <div class="form-group col-md-6">
        <label for="name" class="control-label">{{ __('transaction.TABLE-name') }}</label>
        <input name="name" id="name" class="form-control" value="{{ old('name', $transaction['name']) }}" placeholder="{{ __('transaction.TABLE-name') }}" />
      </div>
      <div class="form-group col-md-6">
        <label for="transaction_type">{{ __('transaction.TABLE-tpye') }}</label>
        <select id="transaction_type" name="transaction_type" class="custom-select">
          <option value="1">{{ __('transaction.TABLE-services') }}</option>
          <option value="2">{{ __('transaction.TABLE-general-goods') }}</option>
          <option value="3">{{ __('transaction.TABLE-brokerage') }}</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="from_date" class="control-label">{{ __('transaction.TABLE-from') }}:</label>
        <input name="from_date" class="form-control" value="{{$transaction['from_date']}}" type="date" readonly />
        <span asp-validation-for="FromDate" class="text-danger"></span>
      </div>
      <div class="form-group col-md-6">
        <label for="to_date" class="control-label">{{ __('transaction.TABLE-to') }}:</label>
        <input name="to_date" class="form-control" value="{{ old('to_date', $transaction['to_date']) }}" type="date" />
        <span asp-validation-for="ToDate" class="text-danger"></span>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-12">
        <label for="commission_payer">{{ __('transaction.TABLE-payment-type') }}: </label>
        <select name="commission_payer" class="custom-select">
          <option value="principal">{{ __('transaction.TABLE-customer') }}</option>
          <option value="contractor">{{ __('transaction.TABLE-contractor') }}</option>
          <option value="half">{{ __('transaction.TABLE-half') }}</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-4">
        <label for="bank_name" class="control-label">{{ __('transaction.TABLE-bank-name') }}</label>
        <select name="bank_name" class="custom-select">
          @foreach($banks as $bank)
          <option>{{ $bank->bank_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="currency_name" class="control-label">{{ __('transaction.TABLE-currency') }} </label>
        <select name="currency_name" class="custom-select">
          @foreach($currencies as $currency)
          <option>{{ $currency->symbol }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="amount" class="control-label">{{ __('transaction.TABLE-amount') }}</label>
        <input name="amount" class="form-control" value="{{ old('amount', $transaction['amount']) }}" />
        <span asp-validation-for="amount" class="text-danger"></span>
      </div>
      <div class="form-group col-md-4">
        <label for="payment" class="control-label">{{ __('transaction.TABLE-payment') }}</label>
        <input name="payment" id="payment" class="form-control" value="{{ old('payment', $transaction['payment']) }}" />
        <span asp-validation-for="payment" class="text-danger"></span>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-12">
        <label for="description" class="control-label">{{ __('transaction.TABLE-description') }}</label>
        <textarea asp-for="description" class="form-control" name="description" id="description" placeholder="Opis" cols="80" value="{{$transaction['description']}}" rows="3">{{ old('description', $transaction['description']) }}</textarea>
        <span asp-validation-for="description" class="text-danger"></span>
      </div>
    </div>
  </fieldset>
  <div class="row">
    <div class="form-group col-md-12 text-center mt-md-4">
      <input type="submit" value="{{ __('transaction.EDI-save') }}" class="btn btn-primary" />
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 mb-md-2">
      <div id="progressBar" class="progress d-none">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span id="progressText"></span></div>
      </div>
    </div>

</form>
@endsection
