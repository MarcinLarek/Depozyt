@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Edytuj walute - <strong>{{ $currency->name }}</strong></h1>
    <hr/>
    @if ($errors->any())
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
            @error('name')
            {{ $message }}
            @enderror
            @error('symbol')
            {{ $message }}
            @enderror
        </div>
    </div>
    <form method="post" action="{{ route('admin.currencies.update', ['id' => $currency->id]) }}" class="w-50 mx-auto">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="form-group col-md-8">
                <label for="name">Nazwa</label>
                <input type="text" name="name" id="name" class="form-control"
                       placeholder="nazwa" value="{{ old('name', $currency->name) }}">
            </div>
            <div class="form-group col-md-4">
                <label for="symbol">Symbol</label>
                <input type="text" name="symbol" id="symbol" class="form-control"
                       placeholder="symbol" value="{{ old('symbol', $currency->symbol) }}">
            </div>
        </div>
        <div class="row py-3">
            <input type="submit" class="btn btn-primary mx-auto" value="Edytuj walute"/>
        </div>
    </form>
@endsection
