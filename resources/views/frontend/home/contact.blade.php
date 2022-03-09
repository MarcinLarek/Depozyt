@extends('frontend.layout.master')
@section('content')
<h1 class="mt-md-4">{{ __('home.CON-title') }}</h1>
<hr />
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card border-0">
            <div class="card-body">
                <form id="Contact" action="{{ route('sendcontact') }}" method="post">
                    <fieldset>
                      @csrf
                        <div class="row align-items-center justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="email" class="control-label">{{ __('home.CON-email') }}</label>
                                <input name="email" id="email" class="form-control" placeholder="{{ __('home.CON-email') }}"/>
                                <span asp-validation-for="Email" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="message" class="control-label">{{ __('home.CON-message') }}</label>
                                <textarea name="message" id="message" class="form-control" placeholder="{{ __('home.CON-message') }}"></textarea>

                                <span asp-validation-for="Email" class="text-danger"></span>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-md-12 text-center mt-md-4">
                            <input type="submit" value="{{ __('home.CON-send') }}" class="btn btn-primary" />
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center">
                  @if(session()->has('issend'))
                  <p>{{ __('home.CON-issend') }}</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
