@extends('frontend.layout.master')

@section('content')

<h1 class="mt-md-4">{{ __('client.IND-title') }}</h1>
<hr />
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="alert alert-dismissible alert-warning">
      <h4 class="alert-heading">{{ __('client.IND-warning_top') }}!</h4>
      <p class="mb-0">{{ __('client.IND-warning_bottom') }}</p>
    </div>
    <div class="card border-0">
      <div class="card-body">
        <h4 class="card-title">{{ __('client.IND-subtitle') }}</h4>


        <form id="edituserdata" action="{{ route('client.update') }}" enctype="multipart/form-data" method="post">
          @csrf
          @method('PATCH')
          <fieldset>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6">
                <label for="username" class="control-label">{{ __('client.IND-login') }}</label>
                <input name="username" id="username" class="form-control" readonly="readonly" placeholder="{{ __('client.IND-login') }}" value="{{ $userData->username }}" />
              </div>
            </div>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6">
                <label for="newpassword" class="control-label">{{ __('client.IND-password') }}</label>
                <input name="newpassword" type="password" id="newpassword" class="form-control" placeholder="{{ __('client.IND-password') }}" />
                @error('newpassword')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6">
                <label for="email" class="control-label">{{ __('client.IND-email') }}</label>
                <input name="email" id="email" class="form-control" placeholder="{{ __('client.IND-email') }}" value="{{ old('email', $userData->email) }}" />
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('client.IND-save') }}" class="btn btn-primary" />
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
                {{ __('client.IND-succes') }}
              </div>
            </div>
            <div class="col-md-12 mt-md-2">
              <div id="invalidAlert" class="alert alert-danger d-none">
                {{ __('client.IND-failure') }}
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="card-body">
        <form id="edituserdata" action="{{ route('client.updatephone') }}" enctype="multipart/form-data" method="post">
          @csrf
          @method('PATCH')
          <fieldset>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6">
                <label for="phone" class="control-label">{{ __('client.IND-phone') }}</label>
                <input name="phone" id="phone" class="form-control" placeholder="{{ __('client.IND-phone') }}" value="{{ auth()->user()->phone }}" />
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('client.IND-save') }}" class="btn btn-primary" />
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
@endsection
