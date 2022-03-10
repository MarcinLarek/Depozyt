@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('company.COM-title') }}</h1>
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
@if(session()->has('successalert'))
<div class="alert alert-success">
  <h1>{{ __('alerts.data_save_success') }}</h1>
</div>
@endif
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card border-0">
      <div class="card-body">
        <form action="{{ route('company-data.edit') }}" method="post">
          @csrf
          <fieldset>
            <legend>{{ __('company.COM-subtitle1') }}</legend>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="name" class="control-label">{{ __('company.COM-name') }}</label>
                <input name="name" id="name" class="form-control" placeholder="{{ __('company.COM-name') }}" value="{{ old('name', $companyData->name) }}" />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="nip" class="control-label">{{ __('company.COM-nip') }}</label>
                <input name="nip" id="nip" class="form-control" placeholder="{{ __('company.COM-nip') }}" value="{{ old('nip', $companyData->nip) }}" />
              </div>
              <div class="form-group col-md-4">
                <label for="regon" class="control-label">{{ __('company.COM-regon') }}</label>
                <input name="regon" id="regon" class="form-control" placeholder="{{ __('company.COM-regon') }}" value="{{ old('regon', $companyData->regon) }}" />
              </div>
              <div class="form-group col-md-4">
                <label for="krs" class="control-label">{{ __('company.COM-krs') }}</label>
                <input name="krs" id="krs" class="form-control" placeholder="{{ __('company.COM-krs') }}" value="{{ old('krs', $companyData->krs) }}" />
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>{{ __('company.COM-subtitle2') }}</legend>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="email" class="control-label">{{ __('company.COM-email') }}</label>
                <input name="email" id="email" class="form-control" placeholder="{{ __('company.COM-email') }}" value="{{ old('email', $companyData->email) }}" />
              </div>
              <div class="form-group col-md-6">
                <label for="phone-number" class="control-label">{{ __('company.COM-telephone') }}</label>
                <input name="phone_number" id="phone-number" class="form-control" placeholder="{{ __('company.COM-telephone') }}" value="{{ old('phone_number', $companyData->phone_number) }}" />
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>{{ __('company.COM-subtitle3') }}</legend>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="street" class="control-label">{{ __('company.COM-street') }}</label>
                <input name="street" id="street" class="form-control" placeholder="{{ __('company.COM-street') }}" value="{{ old('name', $companyData->street) }}" />
              </div>
              <div class="form-group col-md-4">
                <label for="post-code" class="control-label">{{ __('company.COM-postcode') }}</label>
                <input name="post_code" id="post-code" class="form-control" placeholder="{{ __('company.COM-postcode') }}" value="{{ old('name', $companyData->post_code) }}" />
              </div>
              <div class="form-group col-md-4">
                <label for="city" class="control-label">{{ __('company.COM-city') }}</label>
                <input name="city" id="city" class="form-control" placeholder="{{ __('company.COM-city') }}" value="{{ old('city', $companyData->city) }}" />
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('company.COM-save') }}" class="btn btn-primary" />
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
                {{ __('company.COM-success') }}
              </div>
            </div>
            <div class="col-md-12 mt-md-2">
              <div id="invalidAlert" class="alert alert-danger d-none">
                {{ __('company.COM-failure') }}
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/js/company-data.min.js') }}"></script>
@endsection
