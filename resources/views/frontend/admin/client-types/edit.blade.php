@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Edytuj typ klienta - <strong>{{ $clientType->getName() }}</strong></h1>
<hr />
<form method="post" action="{{ route('admin.client-types.update', ['id' => $clientType->id]) }}" class="w-50 mx-auto">
  @csrf
  @method('PUT')

  <div class="row">
    <div class="form-group col-md-8 mx-auto">
      <label for="name">Typ Klienta</label>
      <input type="text" name="name" id="name" class="form-control" placeholder="Typ Klienta" value="{{ old('name', $clientType->getName()) }}">
      @error('name')
      <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="row py-3">
    <input type="submit" class="btn btn-primary mx-auto" value="Edytuj typ klienta" />
  </div>
</form>
@endsection
