@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Edytuj kraj - <strong>{{ $country->getCountryName() }}</strong></h1>
<hr />
<form method="post" action="{{ route('admin.countries.update', ['id' => $country->id]) }}" class="w-50 mx-auto">
  @csrf
  @method('PUT')

  <div class="row">
    <div class="form-group col-md-8">
      <label for="country-name">Nazwa</label>
      <input type="text" name="country_name" id="country-name" class="form-control" placeholder="Nazwa" value="{{ old('country_name', $country->getCountryName()) }}">
      @error('country_name')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="country-code">Kod kraju</label>
      <input type="text" name="country_code" id="country-code" class="form-control" placeholder="Kod kraju" value="{{ old('country_code', $country->getCountryCode()) }}">
      @error('country_code')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="row py-3">
    <input type="submit" class="btn btn-primary mx-auto" value="Edytuj kraj" />
  </div>
</form>
@endsection
