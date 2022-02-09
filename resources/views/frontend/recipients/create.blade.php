@extends('frontend.layout.master')

@section('content')
    <h1 class="mt-md-4">{{ __('recipient.EDI-title') }}</h1>
    <hr/>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-0">
                <div class="card-body">
                    <form method="post" action="{{ route('recipients.store') }}">
                        @csrf

                        <fieldset>
                            <legend>{{ __('recipient.EDI-subtitle1') }}</legend>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="control-label">{{ __('recipient.EDI-recipient_name') }}</label>
                                    <input name="name" id="name" class="form-control" placeholder="{{ __('recipient.EDI-recipient_name') }}" value="{{ old('name') }}"/>
                                    @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nip" class="control-label">{{ __('recipient.EDI-nip') }}</label>
                                    <input name="nip" id="nip" class="form-control" placeholder="{{ __('recipient.EDI-nip') }}" value="{{ old('nip') }}"/>
                                    @error('nip')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="account-number"
                                           class="control-label">{{ __('recipient.EDI-account_number') }}</label>
                                    <a class="alert-link" data-toggle="modal" href="#myModal">
                                        <img class="ml-2" src="{{asset('/images/info.svg')}}"
                                             title="{{ __('recipient.EDI-POP-number-title') }}" alt=""/>
                                    </a>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div id="countryValue"
                                                 class="input-group-text">{{ Auth::user()->country->getCountryCode() }}</div>
                                        </div>
                                        <input name="account_number" id="account-number" class="form-control"
                                               placeholder="Nr konta" value="{{ old('account_number') }}"/>
                                    </div>
                                    @error('account_number')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>{{ __('recipient.EDI-subtitle2') }}</legend>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email" class="control-label">{{ __('recipient.EDI-email') }}</label>
                                    <input name="email" id="email" class="form-control" placeholder="{{ __('recipient.EDI-email') }}" value="{{ old('email') }}"/>
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone" class="control-label">{{ __('recipient.EDI-telephone') }}</label>
                                    <input name="phone" id="phone" class="form-control" placeholder="{{ __('recipient.EDI-telephone') }}" value="{{ old('phone') }}"/>
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>{{ __('recipient.EDI-subtitle3') }}</legend>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="street" class="control-label">{{ __('recipient.EDI-street') }}</label>
                                    <input name="street" id="street" class="form-control" placeholder="{{ __('recipient.EDI-street') }}" value="{{ old('street') }}"/>
                                    @error('street')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="post-code" class="control-label">{{ __('recipient.EDI-postcode') }}</label>
                                    <input name="post_code" id="post-code" class="form-control"
                                           placeholder="{{ __('recipient.EDI-postcode') }}" value="{{ old('post_code') }}"/>
                                    @error('post_code')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city" class="control-label">{{ __('recipient.EDI-city') }}</label>
                                    <input name="city" id="city" class="form-control" placeholder="{{ __('recipient.EDI-city') }}" value="{{ old('city') }}"/>
                                    @error('city')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="form-group col-md-12 text-center mt-md-4">
                                <input type="submit" value="{{ __('recipient.EDI-save') }}" class="btn btn-primary ml-5"/>
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
@endsection
