@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('company.REP-title') }}</h1>
<hr />
@if(session()->has('successalert'))
<div class="alert alert-success">
  <h1>{{ __('alerts.data_save_success') }}</h1>
</div>
@endif
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card border-0">
      <div class="card-body">
        <h4 class="card-title">{{ __('company.REP-subtitle') }}</h4>
        <form id="edit" action="{{ route('representative.edit') }}" method="post">
          @csrf
          <fieldset>
            <legend>{{ __('company.REP-subtitle1') }}</legend>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="surname" class="control-label">{{ __('company.REP-surname') }}</label>
                <input name="surname" id="surname" class="form-control" placeholder="{{ __('company.REP-surname') }}" value="{{ old('surname', $representative->surname) }}" />
                @error('surname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="name" class="control-label">{{ __('company.REP-name') }}</label>
                <input name="name" id="name" class="form-control" placeholder="{{ __('company.REP-name') }}" value="{{ old('surname', $representative->name) }}" />
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="pesel" class="control-label">{{ __('company.REP-pesel') }}</label>
                <input name="pesel" id="pesel" class="form-control" placeholder="{{ __('company.REP-pesel') }}" value="{{ old('pesel', $representative->pesel) }}" />
                @error('pesel')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="document-type" class="control-label">{{ __('company.REP-document_type') }}</label>
                <select name="document_type" id="document-type" class="custom-select">
                  <option value="ID Card">{{ __('company.REP-idcard') }}</option>
                  <option value="Passport">{{ __('company.REP-passport') }}</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="document-number" class="control-label">{{ __('company.REP-document_number') }}</label>
                <input name="document_number" id="document-number" class="form-control" placeholder="{{ __('company.REP-document_number') }}" value="{{ old('document_number', $representative->document_number) }}" />
                @error('document_number')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>{{ __('company.COM-subtitle2') }}</legend>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="email" class="control-label">{{ __('company.COM-email') }}</label>
                <input name="email" id="email" class="form-control" placeholder="{{ __('company.COM-email') }}" value="{{ old('email', $representative->email) }}" />
                <span asp-validation-for="Email" class="text-danger"></span>
              </div>
              <div class="form-group col-md-6">
                <label for="phone-number" class="control-label">{{ __('company.COM-telephone') }}</label>
                <input name="phone" id="phone-number" class="form-control" placeholder="{{ __('company.COM-telephone') }}" value="{{ old('phone', $representative->phone) }}" />
                <span asp-validation-for="PhoneNumber" class="text-danger"></span>
              </div>
            </div>
          </fieldset>
          <fieldset>
            <legend>{{ __('company.COM-subtitle3') }}</legend>
            <div class="row">
              <div class="form-group col-md-4">
                <label for="street" class="control-label">{{ __('company.COM-street') }}</label>
                <input name="street" id="street" class="form-control" placeholder="{{ __('company.COM-street') }}" value="{{ old('street', $representative->street) }}" />
              </div>
              <div class="form-group col-md-4">
                <label for="post-code" class="control-label">{{ __('company.COM-postcode') }}</label>
                <input name="post_code" id="post-code" class="form-control" placeholder="{{ __('company.COM-postcode') }}" value="{{ old('postcode', $representative->post_code) }}" />
              </div>
              <div class="form-group col-md-4">
                <label for="city" class="control-label">{{ __('company.COM-city') }}</label>
                <input name="city" id="city" class="form-control" placeholder="{{ __('company.COM-city') }}" value="{{ old('city', $representative->city) }}" />
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="Zapisz" class="btn btn-primary" />
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
<script src="{{ asset('/js/representative.min.js') }}"></script>
@endsection
