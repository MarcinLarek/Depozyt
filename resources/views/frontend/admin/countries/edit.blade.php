@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Edytuj kraj - <strong>{{ $country->getCountryName() }}</strong></h1>
    <hr/>
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
    <form method="post" action="{{ route('admin.countries.update', ['id' => $country->id]) }}" class="w-50 mx-auto">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="form-group col-md-8">
                <label for="country-name">Nazwa</label>
                <input type="text" name="country_name" id="country-name" class="form-control"
                       placeholder="Nazwa" value="{{ old('country_name', $country->getCountryName()) }}">
            </div>
            <div class="form-group col-md-4">
                <label for="country-code">Kod kraju</label>
                <input type="text" name="country_code" id="country-code" class="form-control"
                       placeholder="Kod kraju" value="{{ old('country_name', $country->getCountryCode()) }}">
            </div>
        </div>
        <div class="row py-3">
            <input type="submit" class="btn btn-primary mx-auto" value="Edytuj kraj"/>
        </div>
    </form>
@endsection
