@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('sigin.FOR-title') }}</h1>
<hr />
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card border-0">
            <div class="card-body">
                <h4 class="card-title">{{ __('sigin.FOR-subtitle') }}</h4>
                <form id="Forgot" action="{{ route('client.ForgotPasswordReset') }}" method="post">
                    <fieldset>
                      @csrf
                        <div class="row align-items-center justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="email" class="control-label">{{ __('sigin.FOR-email') }}</label>
                                <input name="email" id="email" class="form-control" placeholder="{{ __('sigin.FOR-email') }}"/>
                                <span asp-validation-for="Email" class="text-danger"></span>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-md-12 text-center mt-md-4">
                            <input type="submit" value="{{ __('sigin.FOR-save') }}" class="btn btn-primary" />
                        </div>
                    </div>
                    @if($wrongemail === 1)
                    <div class="row">
                        <h5>{{ __('sigin.FOR-wrongemail') }}</h5>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
