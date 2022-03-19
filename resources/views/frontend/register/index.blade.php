@extends('frontend.layout.master')
@section('content')
<h1 class="mt-md-4">{{ __('register.IND-title') }}</h1>
<hr />
@if (session()->has('registersucces'))
<div class="alert alert-success">
  <h1>{{ __('register.IND-registersucces') }}</h1>
</div>
@endif
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card  border-0">
      <div class="card-body">
        <h4 class="card-title">{{ __('register.IND-subtitle') }}</h4>
        <form action="{{ route('register.store') }}" method="post">
          @csrf
          <fieldset>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="username" class="control-label">{{ __('register.IND-username') }}</label>
                <input name="username" id="username" class="form-control" placeholder="{{ __('register.IND-username') }}" value="{{ old('username') }}" />
                @error('username')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="password" class="control-label">{{ __('register.IND-password') }}</label>
                <a class="alert-link" data-toggle="modal" href="#myModal">
                  <img class="ml-2" src="{{ asset('/images/info.svg') }}" title="{{ __('sigin.SET-passwordhelp') }}" />
                </a>
                <input name="password" id="password" type="password" class="form-control" placeholder="{{ __('register.IND-password') }}" value="{{ old('password') }}" />
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="password_confirmation" class="control-label">{{ __('register.IND-confirm_password') }}</label>
                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="{{ __('register.IND-confirm_password') }}" value="{{ old('password_confirmation ') }}" />
                @error('password_confirmation')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="email" class="control-label">{{ __('register.IND-email') }}</label>
                <input name="email" id="email" class="form-control" placeholder="{{ __('register.IND-email') }}" value="{{ old('email') }}" />
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="client_type" class="control-label">{{ __('register.IND-client_type') }}</label>
                <select name="client_type_id" id="client_type" class="custom-select">
                  @foreach(\App\Models\ClientType::all() as $clientType)
                  <option value="{{ $clientType->getId() }}">{{ $clientType->getName() }}</option>
                  @endforeach
                </select>
                @error('client_type_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <label for="country" class="control-label">{{ __('register.IND-country') }}</label>
                <select name="country_id" id="country" class="custom-select">
                  @foreach(\App\Models\Country::all() as $country)
                  <option value="{{ $country->getId() }}">{{ $country->getCountryName() }}</option>
                  @endforeach
                </select>
                @error('country')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-12">
                <div class="custom-control custom-checkbox">
                  <input name="terms-and-conditions" id="terms-and-conditions" class="custom-control-input" type="checkbox" value="1">
                  <label for="terms-and-conditions" class="custom-control-label">
                    {{ __('register.IND-accept_statute1') }}
                    <a href="{{ route('regulations') }}">{{ __('register.IND-accept_statute2') }}</a>
                  </label><br />
                  @error('terms-and-conditions')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('register.IND-register') }}" class="btn btn-primary" />
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ __('sigin.SET-passwordhelp') }}</h5>
        <button class="close" aria-label="Close" type="button" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{{ __('sigin.SET-passwordhelp2') }}</p>
      </div>
    </div>
  </div>
</div>
@endsection
