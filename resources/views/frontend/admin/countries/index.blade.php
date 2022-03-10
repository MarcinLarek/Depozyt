@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Kraje</h1>
<hr />
@if(session()->has('successalert'))
<div class="alert alert-success">
  <h1>Zmiany zostały zapisane</h1>
</div>
@elseif ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
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
        <label for="country_name">Nazwa</label>
        <input type="text" name="country_name" id="country_name" class="form-control" placeholder="Nazwa" value="{{ old('country_name') }}">
      </div>
      <div class="form-group col-md-4">
        <label for="country_code">Kod kraju</label>
        <input type="text" name="country_code" id="country_code" class="form-control" placeholder="Kod kraju" value="{{ old('country_code') }}">
      </div>
    </div>
    <div class="row py-3">
      <input type="submit" class="btn btn-primary mx-auto" value="Dodaj kraj" />
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
        @if($countries->isNotEmpty())
        @foreach($countries as $country)
        <tr>
          <td>{{ $i }}</td>
          <td>{{ $country->getCountryName() }}</td>
          <td>{{ $country->getCountryCode() }}</td>
          <td>
            <a href="{{ route('admin.countries.edit', ['id' => $country->id]) }}">
              <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj Kraj" />
            </a>
          </td>
        </tr>
        <?php $i++ ?>
        @endforeach
        @else
        <tr>
          <td colspan="4">Brak danych do wyświetlenia</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection
