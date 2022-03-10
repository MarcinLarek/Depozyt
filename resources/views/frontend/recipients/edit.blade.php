@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('recipient.EDI-title') }}</h1>
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
        <form action="{{ route('recipients.update', $recipient->getId()) }}" method="post">
          @csrf
          @method('PUT')
          <fieldset>
            <legend>{{ __('recipient.EDI-subtitle1') }}</legend>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name" class="control-label">{{ __('recipient.EDI-recipient_name') }}</label>
                <input name="name" id="name" class="form-control" placeholder="{{ __('recipient.EDI-recipient_name') }}" value="{{ old('name', $recipient->name) }}" />
                <span asp-validation-for="Name" class="text-danger"></span>
              </div>
              <div class="form-group col-md-6">
                <label for="nip" class="control-label">{{ __('recipient.EDI-nip') }}</label>
                <input name="nip" id="nip" class="form-control" placeholder="{{ __('recipient.EDI-nip') }}" value="{{ old('name', $recipient->nip) }}" />
                <span asp-validation-for="Nip" class="text-danger"></span>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="account_number" class="control-label">{{ __('recipient.EDI-account_number') }}</label>
                <a class="alert-link" data-toggle="modal" href="#myModal">
                  <img class="ml-2" src="{{asset('/images/info.svg')}}" title="{{ __('recipient.EDI-POP-number-title') }}" alt="" />
                </a>
                <div class="input-group mb-2">
                  <div class="input-group-prepend">
                    <div id="countryValue" class="input-group-text">{{ Auth::user()->country->getCountryCode() }}</div>
                    <input type="hidden" value="{{ Auth::user()->country->id }}" name="country_id" />
                  </div>
                  <input name="account_number" id="account_number" class="form-control" placeholder="  {{ __('recipient.EDI-account_number') }}" value="{{ old('account_number', $recipient->getAccountNumber()) }}" />
                </div>
                <span asp-validation-for="AccountNumber" class="text-danger"></span>
              </div>
              <div class="form-group col-md-6">
                <label for="bank-name" class="control-label">{{ __('clientbankaccounts.EDI-name') }}</label>
                <input name="bank_name" id="bank-name" class="form-control" placeholder="{{ __('clientbankaccounts.EDI-name') }}" value="{{ old('bank_name') }}" />
                @error('bank_name')<span class="text-danger">{{ $message }}</span>@enderror
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>{{ __('recipient.EDI-subtitle2') }}</legend>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="email" class="control-label">{{ __('recipient.EDI-email') }}</label>
                <input name="email" id="email" class="form-control" placeholder="{{ __('recipient.EDI-email') }}" value="{{ old('email', $recipient->email) }}" />
                <span asp-validation-for="Email" class="text-danger"></span>
              </div>
              <div class="form-group col-md-6">
                <label for="phone" class="control-label">{{ __('recipient.EDI-telephone') }}</label>
                <input name="phone" id="phone" class="form-control" placeholder="{{ __('recipient.EDI-telephone') }}" value="{{ old('phone', $recipient->phone) }}" />
                <span asp-validation-for="PhoneNumber" class="text-danger"></span>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>{{ __('recipient.EDI-subtitle3') }}</legend>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="street" class="control-label">{{ __('recipient.EDI-street') }}</label>
                <input name="street" id="street" class="form-control" placeholder="{{ __('recipient.EDI-street') }}" value="{{ old('street', $recipient->street) }}" />
                <span asp-validation-for="Street" class="text-danger"></span>
              </div>
              <div class="form-group col-md-4">
                <label for="post-code" class="control-label">{{ __('recipient.EDI-postcode') }}</label>
                <input name="post_code" id="post-code" class="form-control" placeholder="{{ __('recipient.EDI-postcode') }}" value="{{ old('post_code', $recipient->getPostCode()) }}" />
                <span asp-validation-for="PostCode" class="text-danger"></span>
              </div>
              <div class="form-group col-md-4">
                <label for="city" class="control-label">{{ __('recipient.EDI-city') }}</label>
                <input name="city" id="city" class="form-control" placeholder="{{ __('recipient.EDI-city') }}" value="{{ old('city', $recipient->getCity()) }}" />
                <span asp-validation-for="City" class="text-danger"></span>
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="active" class="control-label">{{ __('recipient.EDI-is_recipient_active') }}</label>
              <a class="alert-link" data-toggle="modal" href="#myModal2">
                <img class="ml-2" src="{{ asset('/images/info.svg') }}" title="{{ __('recipient.EDI-POP-activate-title') }}" />
              </a>
              <select name="active" id="active" class="custom-select">
                <option value="1" {{$recipient->isActive() ? 'selected' : ''}}> {{ __('recipient.EDI-yes') }}</option>
                <option value="0" {{!$recipient->isActive() ? 'selected' : ''}}> {{ __('recipient.EDI-no') }}</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('recipient.EDI-save') }}" class="btn btn-primary" />
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
                {{ __('recipient.EDI-succes') }}
              </div>
            </div>
            <div class="col-md-12 mt-md-2">
              <div id="invalidAlert" class="alert alert-danger d-none">
                {{ __('recipient.EDI-failure') }}
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div>
  <a href="{{ route('recipients') }}">{{ __('recipient.EDI-goback') }}</a>
</div>

<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('recipient.EDI-POP-number-title') }}</h5>
        <button class="close" aria-label="Close" type="button" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ __('recipient.EDI-POP-number-subtitle') }}</p>
        <p><strong>{{ __('recipient.EDI-POP-number-1') }}</strong>{{ __('recipient.EDI-POP-number-2') }}</p>
        <p><strong>{{ __('recipient.EDI-POP-number-3') }}</strong>{{ __('recipient.EDI-POP-number-4') }}</p>
        <p>{{ __('recipient.EDI-POP-number-example') }}</p>
      </div>
    </div>
  </div>
</div>
<div id="myModal2" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('recipient.EDI-POP-activate-title') }}</h5>
        <button class="close" aria-label="Close" type="button" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ __('recipient.EDI-POP-activate-subtitle') }}</p>
        <p><strong>{{ __('recipient.EDI-POP-activate-act1') }} - </strong>{{ __('recipient.EDI-POP-activate-act2') }}</p>
        <p><strong>{{ __('recipient.EDI-POP-activate-noact1') }}</strong>{{ __('recipient.EDI-POP-activate-noact2') }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
