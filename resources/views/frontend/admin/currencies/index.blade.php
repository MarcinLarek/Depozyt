@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Waluty</h1>
    <hr/>
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
    <div class="w-50 mx-auto">
        <form method="post" action="{{ route('admin.currencies.store') }}">
            @csrf
            <div class="row">
                <div class="form-group col-md-8">
                    <label for="name">Nazwa</label>
                    <input type="text" name="name" id="name" class="form-control"
                           placeholder="Nazwa" value="{{ old('name') }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="symbol">Symbol</label>
                    <input type="text" name="symbol" id="symbol" class="form-control"
                           placeholder="Symbol" value="{{ old('symbol') }}">
                </div>
            </div>
            <div class="row py-3">
                <input type="submit" class="btn btn-primary mx-auto" value="Dodaj walute"/>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Lp</th>
                    <th>Nazwa</th>
                    <th>Symbol</th>
                    <th>Edytuj</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($currencies as $currency)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $currency->name }}</td>
                        <td>{{ $currency->symbol }}</td>
                        <td>
                            <a href="{{ route('admin.currencies.edit', ['id' => $currency->id]) }}">
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
