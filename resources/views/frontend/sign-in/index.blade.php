@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('sigin.IND-title') }}</h1>
<hr />

@if($errortype==1)
<div class="alert alert-warning">
  <h2>{{ __('sigin.IND-errortype1') }}</h2>
</div>
@elseif($errortype==2)
<div class="alert alert-warning">
  <h2>{{ __('sigin.IND-errortype2') }}</h2>
</div>
@endif
@if(isset($codesucces))
<div class="alert alert-success">
<h2>{{ __('sigin.IND-success') }}</h2>
</div>
@endif
<div clasms="row">
  <div class="col-md-8 offset-md-2">
    <div class="card border-0">
      @if(isset($codesucces))
      <div class="card-body">
        <h4 class="card-title">{{ __('sigin.IND-subtitle') }}</h4>
        <form action="{{ route('client.phonecode') }}" method="post">
          @csrf
          <fieldset>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6">
                <label for="phone_code" class="control-label">{{ __('sigin.IND-authcode') }}</label>
                <input name="phone_code" id="phone_code" class="form-control" placeholder="{{ __('sigin.authcode') }}" value="{{ old('phone_code') }}" />
                @error('phone_code')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <input name="token" id="token" type="hidden" class="form-control" value="{{ $usertoken }}" />
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('sigin.IND-sigin') }}" class="btn btn-primary" />
            </div>
          </div>

            @if ($failstatus == 1)
            <div>
              <div>
                <strong>{{ __('sigin.IND-error1') }}</strong>{{ __('sigin.IND-error2') }}<br /> {{ __('sigin.IND-error3') }}
              </div>
              @endif

            </div>
      </div>
      </form>
      </div>
      @else
      <div class="card-body">
        <h4 class="card-title">{{ __('sigin.IND-subtitle') }}</h4>
        <form action="{{ route('client.sign-in') }}" method="post">
          @csrf
          <fieldset>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6">
                <label for="username" class="control-label">{{ __('sigin.IND-usernameoremail') }}</label>
                <input name="username" id="username" class="form-control" value="{{ old('username') }}" placeholder="{{ __('sigin.IND-usernameoremail') }}" />
                @error('username')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6">
                <label for="password" class="control-label">{{ __('sigin.IND-password') }}</label>
                <input name="password" id="password" class="form-control" type="password" value="{{ old('password') }}" placeholder="{{ __('sigin.IND-password') }}" />
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6 text-right">
                <a href="/ForgotPassword">{{ __('sigin.IND-forgotpassword') }}</a>
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('sigin.IND-sigin') }}" class="btn btn-primary" />
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mb-md-2">
              <div id="progressBar" class="progress d-none">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span id="progressText"></span></div>
              </div>
            </div>

            @if ($failstatus == 1)
            <div>
              <div>
                <strong>{{ __('sigin.IND-error1') }}</strong>{{ __('sigin.IND-error2') }}<br /> {{ __('sigin.IND-error3') }}
              </div>
              @endif

            </div>
        </form>
      </div>
      </div>
      @endif
  </div>
</div>
@endsection
