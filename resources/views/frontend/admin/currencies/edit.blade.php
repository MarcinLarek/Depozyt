@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Edytuj walute - <strong>{{ $currency->name }}</strong></h1>
<hr />
<form method="post" action="{{ route('admin.currencies.update', ['id' => $currency->id]) }}" class="w-50 mx-auto">
  @csrf
  @method('PUT')

  <div class="row">
    <div class="form-group col-md-8">
      <label for="name">Nazwa</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="nazwa" value="{{ old('name', $currency->name) }}">
      @error('name')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
    <div class="form-group col-md-4">
      <label for="symbol">Symbol</label>
      <input type="text" name="symbol" id="symbol" class="form-control" placeholder="symbol" value="{{ old('symbol', $currency->symbol) }}">
      @error('symbol')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="row py-3">
    <input type="submit" class="btn btn-primary mx-auto" value="Edytuj walute" />
  </div>
</form>
@endsection
