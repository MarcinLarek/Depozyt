@extends('frontend.layout.master')
@section('content')
<h1 class="mt-md-4">{{ __('sigin.SET-title') }}</h1>
<hr />
<div class="row">
  <div class="col-md-8 offset-md-2">
    <div class="card border-0">
      <div class="card-body">
        <h4 class="card-title">{{ __('sigin.SET-subtitle') }}</h4>
        <form id="Reset" action="{{ route('SetNewPasswordUpdate',['Token' => $token])  }}" method="post">
          @csrf
          <fieldset>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6">
                <label for="UserPassword" class="control-label">{{ __('sigin.SET-password') }}</label>
                <a class="alert-link" data-toggle="modal" href="#myModal">
                  <img class="ml-2" src="{{ asset('/images/info.svg') }}" title="{{ __('sigin.SET-passwordhelp') }}" />
                </a>
                <input name="password" type="password" class="form-control" placeholder="{{ __('sigin.SET-password') }}" />
                <span asp-validation-for="UserPassword" class="text-danger"></span>
              </div>
            </div>
            <div class="row align-items-center justify-content-center">
              <div class="form-group col-md-6">
                <label for="CofirmPassword" class="control-label">{{ __('sigin.SET-confirm_password') }}</label>
                <input name="password_confirmation" type="password" class="form-control" placeholder="{{ __('sigin.SET-confirm_password') }}" />
                <span asp-validation-for="CofirmPassword" class="text-danger"></span>
              </div>
            </div>
          </fieldset>
          <div class="row">
            <div class="form-group col-md-12 text-center mt-md-4">
              <input type="submit" value="{{ __('sigin.SET-save') }}" class="btn btn-primary" />
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
