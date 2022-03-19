@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('clientbankaccounts.EDI-title') }}</h1>
<hr />

<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card border-0">
      <div class="card-body">
        <h4 class="card-title">{{ __('clientbankaccounts.EDI-subtitle') }}<strong>{{ $bankAccount->getName() }}</strong></h4>
        <form id="update" action="{{ route('bank-accounts.update', ['id' => $bankAccount->id]) }}" asp-controller="ClientBankAccount" method="post">
          @csrf
          <input type="hidden" name="id" id="id" value="{{ $bankAccount->id }}">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="bank_name" class="control-label">{{ __('clientbankaccounts.EDI-name') }}</label>
              <input name="bank_name" id="bank_name" class="form-control" placeholder="{{ __('clientbankaccounts.EDI-name') }}" value="{{ old('bank_name', $bankAccount->bank_name) }}" />
              @error('bank_name')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <span asp-validation-for="bank_name" class="text-danger"></span>
            </div>
            <div class="form-group col-md-6">
              <label for="currency-id" class="control-label">{{ __('clientbankaccounts.EDI-currency') }}</label>
              <select name="currency_id" id="currency-id" class="custom-select">
                @foreach(\App\Models\Currency::getActiveCurrency() as $currency)
                <option value="{{ $currency->id }}">{{ $currency->symbol }} - {{ $currency->name }}</option>
                @endforeach
              </select>
              @error('currency_id')
              <span class="text-danger">{{ $message }}</span>
              @enderror
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
                  <input type="hidden" value="{{ Auth::user()->country->id }}" name="country_id" />
                </div>
                <input name="account_number" id="account_number" class="form-control" placeholder="{{ __('clientbankaccounts.EDI-account_number') }}" value="{{ old('account_number', $bankAccount->account_number) }}" />
              </div>
              @error('account_number')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <span asp-validation-for="Number" class="text-danger"></span>
            </div>
            <div class="form-group col-md-6">
              <label for="swift" class="control-label">{{ __('clientbankaccounts.EDI-swift') }}</label>
              <a class="alert-link" data-toggle="modal" href="#myModal">
                <img class="ml-2" src="{{ asset('/images/info.svg') }}" title="{{ __('clientbankaccounts.EDI-requirements') }}" alt="{{ __('clientbankaccounts.EDI-requirements') }}" />
              </a>
              <input name="swift" id="swift" class="form-control" placeholder="Nr SWIFT" value="{{ old('swift', $bankAccount->swift) }}" />
              @error('swift')
              <span class="text-danger">{{ $message }}</span>
              @enderror
              <span asp-validation-for="NumberSwift" class="text-danger"></span>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="active" class="control-label">{{ __('clientbankaccounts.EDI-isactive') }}</label>
              <a class="alert-link" data-toggle="modal" href="#myModal2">
                <img class="ml-2" src="{{ asset('images/info.svg') }}" title="{{ __('clientbankaccounts.EDI-requirements2') }}" alt="{{ __('clientbankaccounts.EDI-requirements2') }}" />
              </a>
              <select name="active" id="active" class="custom-select">
                <option value="1">{{ __('clientbankaccounts.EDI-yes') }}</option>
                <option value="0">{{ __('clientbankaccounts.EDI-no') }}</option>
              </select>
            </div>
            @error('account_number')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('clientbankaccounts.EDI-save') }}" class="btn btn-primary" />
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
                {{ __('clientbankaccounts.EDI-success') }}
              </div>
            </div>
            <div class="col-md-12 mt-md-2">
              <div id="invalidAlert" class="alert alert-danger d-none">
                {{ __('clientbankaccounts.EDI-failure') }}
              </div>
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
<div id="myModal2" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('clientbankaccounts.EDI-POP-activate-title') }}</h5>
        <button class="close" aria-label="Close" type="button" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ __('clientbankaccounts.EDI-POP-activate-subtitle') }}</p>
        <p><strong>{{ __('clientbankaccounts.EDI-POP-activate-act1') }} </strong>{{ __('clientbankaccounts.EDI-POP-activate-act2') }}</p>
        <p><strong>{{ __('clientbankaccounts.EDI-POP-activate-noact1') }}</strong>{{ __('clientbankaccounts.EDI-POP-activate-noact2') }}</p>
      </div>
    </div>
  </div>
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
