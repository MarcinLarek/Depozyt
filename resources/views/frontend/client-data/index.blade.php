@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('clientdata.IND-title') }}</h1>
<hr />
@if($succesaalert == 1)
<div class="alert alert-success">
  <h1>{{ __('alerts.data_save_success') }}</h1>
</div>
@endif
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card border-0">
            <div class="card-body">
                <h4 class="card-title">{{ __('clientdata.IND-subtitlegenral') }}</h4>
                <form action="{{ route('client-data.edit') }}" method="post">
                    @csrf
                    <fieldset>
                        <legend>{{ __('clientdata.IND-subtitle1') }}</legend>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="surname" class="control-label">{{ __('clientdata.IND-surname') }}</label>
                                <input name="surname" id="surname" class="form-control" placeholder="{{ __('clientdata.IND-surname') }}" value="{{ old('surname', $clientData->surname) }}" />
                                @error('surname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name" class="control-label">{{ __('clientdata.IND-name') }}</label>
                                <input name="name" id="name" class="form-control" placeholder="{{ __('clientdata.IND-name') }}" value="{{ old('name', $clientData->name) }}"/>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="pesel" class="control-label">{{ __('clientdata.IND-pesel') }}</label>
                                <input name="pesel" id="pesel" class="form-control" placeholder="{{ __('clientdata.IND-pesel') }}" value="{{ old('pesel', $clientData->pesel) }}"/>
                                @error('pesel')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="document-type" class="control-label">{{ __('clientdata.IND-document_type') }}</label>
                                <select name="document_type" id="document-type" class="custom-select">
                                    <option value="ID Card">{{ __('clientdata.IND-idcard') }}</option>
                                    <option value="Passport">{{ __('clientdata.IND-passport') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="document-number" class="control-label">{{ __('clientdata.IND-document_number') }}</label>
                                <input name="document_number" id="document-number" class="form-control" placeholder="{{ __('clientdata.IND-document_number') }}" value="{{ old('document_number', $clientData->document_number) }}"/>
                                @error('document_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>{{ __('clientdata.IND-subtitle2') }}</legend>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email" class="control-label">{{ __('clientdata.IND-email') }}</label>
                                <input name="email" id="email" class="form-control" placeholder="{{ __('clientdata.IND-email') }}" value="{{ old('email', $clientData->email) }}" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone-number" class="control-label">{{ __('clientdata.IND-telephone') }}</label>
                                <input name="phone" id="phone" class="form-control" placeholder="{{ __('clientdata.IND-telephone') }}" value="{{ old('phone', $clientData->phone) }}"/>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>{{ __('clientdata.IND-subtitle3') }}</legend>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="street" class="control-label">{{ __('clientdata.IND-street') }}</label>
                                <input name="street" id="street" class="form-control" placeholder="{{ __('clientdata.IND-street') }}" value="{{ old('street', $clientData->street) }}"/>
                                @error('street')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="post-code" class="control-label">{{ __('clientdata.IND-postcode') }}</label>
                                <input name="post_code" id="post-code" class="form-control" placeholder="{{ __('clientdata.IND-postcode') }}" value="{{ old('postcode', $clientData->post_code) }}"/>
                                @error('post_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="city" class="control-label">{{ __('clientdata.IND-city') }}</label>
                                <input name="city" id="city" class="form-control" placeholder="{{ __('clientdata.IND-city') }}" value="{{ old('city', $clientData->city) }}"/>
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-md-12 text-center mt-md-4">
                            <input type="submit" value="{{ __('clientdata.IND-save') }}" class="btn btn-primary" />
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
                                {{ __('clientdata.IND-succes') }}
                            </div>
                        </div>
                        <div class="col-md-12 mt-md-2">
                            <div id="invalidAlert" class="alert alert-danger d-none">
                                {{ __('clientdata.IND-failure') }}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
