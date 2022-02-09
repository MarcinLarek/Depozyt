@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Kraje</h1>
    <hr/>
    @if(isset($success) && $success)
        <div class="col-md-12 mt-md-2">
            <div id="successAlert" class="alert alert-success d-none">
                <strong>UDAŁO SIĘ!</strong> Twoje dane zostały zapisane.<br/><strong>Sprawdź
                    skrzynkę pocztową z linkiem aktywacyjnym.</strong>
            </div>
        </div>
    @endif
    @if(isset($success) && !$success)
        <div class="col-md-12 mt-md-2">
            <div id="invalidAlert" class="alert alert-danger d-none">
                <strong>UPS... Coś poszło nie tak!</strong> Twoje dane nie zostały zapisane.
            </div>
        </div>
    @endif
    <div class="col-md-12 mt-md-2">
        <div id="invalidAlert" class="alert alert-danger d-none">
            @error('country_name')
            {{ $message }}
            @enderror
            @error('country_code')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="w-50 mx-auto">
        <form method="post" action="{{ route('admin.countries.store') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="country-name">{{ __('account.country') }}</label>
                    <input type="text" name="country_name" id="country-name" class="form-control"
                           placeholder="{{ __('account.country') }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="country-code">{{ __('account.country-code') }}</label>
                    <input type="text" name="country_code" id="country-code" class="form-control"
                           placeholder="{{ __('account.country-code') }}">
                </div>
            </div>
            <div class="row py-3">
                <input type="submit" class="btn btn-primary mx-auto" value="Dodaj kraj"/>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Lp</th>
                    <th>Nazwa</th>
                    <th>Kod kraju</th>
                    <th>Edytuj</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($countries as $country)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $country->getCountryName() }}</td>
                        <td>{{ $country->getCountryCode() }}</td>
                        <td>
                            <a href="{{ route('admin.countries.edit', ['id' => $country->id]) }}">
                                <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj Kraj"/>
                            </a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
