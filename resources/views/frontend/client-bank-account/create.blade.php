@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('clientbankaccounts.CRE-title') }}</h1>
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
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card border-0">
      <div class="card-body">
        <h4 class="card-title">{{ __('clientbankaccounts.EDI-subtitle') }}</h4>
        <form action="{{ route('bank-accounts.store') }}" method="post">
          @csrf
          <div class="row">
            <div class="form-group col-md-12">
              <label for="name" class="control-label">{{ __('clientbankaccounts.CRE-account_name') }}</label>
              <input name="name" id="name" class="form-control" placeholder="{{ __('clientbankaccounts.CRE-account_name') }}" value="{{ old('name') }}" />
              @error('name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="bank-name" class="control-label">{{ __('clientbankaccounts.EDI-name') }}</label>
              <input name="bank_name" id="bank-name" class="form-control" placeholder="{{ __('clientbankaccounts.EDI-name') }}" value="{{ old('bank_name') }}" />
              @error('bank_name')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="currency-id" class="control-label">{{ __('clientbankaccounts.EDI-currency') }}</label>
              <select name="currency_id" id="currency-id" class="custom-select">
                @foreach(\App\Models\Currency::getActiveCurrency() as $currency)
                <option value="{{ $currency->id }}">{{ $currency->symbol }} - {{ $currency->name }}</option>
                @endforeach
              </select>
              @error('currency_id')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="account-number" class="control-label">{{ __('clientbankaccounts.EDI-account_number') }}</label>
              <a class="alert-link" data-toggle="modal" href="#myModal">
                <img class="ml-2" src="{{ asset('/images/info.svg') }}" title="{{ __('clientbankaccounts.EDI-requirements') }}" alt="{{ __('clientbankaccounts.EDI-requirements') }}" />
              </a>
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div id="countryValue" class="input-group-text">{{ Auth::user()->country->getCountryCode() }}</div>
                </div>
                <input name="account_number" id="account-number" class="form-control" placeholder="{{ __('clientbankaccounts.EDI-account_number') }}" value="{{ old('account_number') }}" />
              </div>
              @error('account_number')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="form-group col-md-6">
              <label for="swift" class="control-label">{{ __('clientbankaccounts.EDI-swift') }}</label>
              <a class="alert-link" data-toggle="modal" href="#myModal">
                <img class="ml-2" src="{{ asset('/images/info.svg') }}" title="{{ __('clientbankaccounts.EDI-requirements') }}" alt="{{ __('clientbankaccounts.EDI-requirements') }}" />
              </a>
              <input name="swift" id="swift" class="form-control" placeholder="{{ __('clientbankaccounts.EDI-swift') }}" value="{{ old('swift') }}" />
              @error('swift')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('clientbankaccounts.EDI-save') }}" class="btn btn-primary" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div>
  <a href="{{ route('bank-accounts') }}">{{ __('clientbankaccounts.EDI-goback') }}</a>
</div>

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('clientbankaccounts.CRE-POP-number-title') }}</h5>
        <button class="close" aria-label="Close" type="button" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ __('clientbankaccounts.CRE-POP-number-subtitle') }}</p>
        <p><strong>{{ __('clientbankaccounts.CRE-POP-number-1') }}</strong>{{ __('clientbankaccounts.CRE-POP-number-2') }}</p>
        <p><strong>{{ __('clientbankaccounts.CRE-POP-number-3') }}</strong>{{ __('clientbankaccounts.CRE-POP-number-4') }}</p>
        <p>{{ __('clientbankaccounts.CRE-POP-number-example') }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
