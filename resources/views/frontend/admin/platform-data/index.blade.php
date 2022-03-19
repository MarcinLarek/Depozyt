@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Edytuj dane platformy</h1>
<hr />
@if(session()->has('successalert'))
<div class="alert alert-success">
  <h1>Zmiany zostały zapisane</h1>
</div>
@endif
<div class="col-md-8 mx-auto">
  <form action="{{ route('admin.platform-data.update') }}" method="post">
    @csrf
    <div class="form-group">
      <label for="company">Nazwa</label>
      <input type="text" id="company" name="company" class="form-control" placeholder="Nazwa" value="{{ old('company', $platformData->company) }}" />
      @error('company')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $platformData->email) }}" />
      @error('email')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="row">
      <div class="form-group col-md-4">
        <label for="nip" class="control-label">NIP</label>
        <input name="nip" id="nip" class="form-control" placeholder="NIP" value="{{ old('nip', $platformData->nip) }}" />
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group col-md-4">
        <label for="krs" class="control-label">KRS</label>
        <input name="krs" id="krs" class="form-control" placeholder="KRS" value="{{ old('krs', $platformData->krs) }}" />
        @error('krs')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group col-md-4">
        <label for="regon" class="control-label">REGON</label>
        <input name="regon" id="regon" class="form-control" placeholder="REGON" value="{{ old('regon', $platformData->regon) }}" />
        @error('regon')
        <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
    </div>
    <fieldset>
      <legend>Adresowe</legend>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="street" class="control-label">Ulica</label>
          <input name="street" id="street" class="form-control" placeholder="Ulica" value="{{ old('street', $platformData->street) }}" />
          @error('street')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group col-md-6">
          <label for="city" class="control-label">Miejscowość</label>
          <input name="city" id="city" class="form-control" placeholder="Miejscowość" value="{{ old('city', $platformData->city) }}" />
          @error('city')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
      </div>
    </fieldset>
    <div class="row">
      <div class="form-group col-md-12 text-center mt-md-4">
        <input type="submit" value="Zapisz" class="btn btn-primary" />
      </div>
    </div>
  </form>
</div>
@endsection
