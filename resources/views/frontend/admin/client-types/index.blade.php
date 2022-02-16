@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Typy konta</h1>
    <hr/>
    @if($succesaalert == 1)
    <div class="alert alert-success">
      <h1>{{ __('alerts.data_save_success') }}</h1>
    </div>
    @endif
    <div class="col-md-12 mt-md-2">
        <div id="invalidAlert" class="alert alert-danger d-none">
            @error('name')
            {{ $message }}
            @enderror
        </div>
    </div>
    <div class="w-50 mx-auto">
        <form method="post" action="{{ route('admin.client-types.store') }}">
            @csrf
            <div class="row">
                <div class="form-group w-100">
                    <label for="name">Typ klienta</label>
                    <input type="text" name="name" id="name" class="form-control"
                           placeholder="Typ klienta">
                </div>
            </div>
            <div class="row py-3">
                <input type="submit" class="btn btn-primary mx-auto" value="Dodaj typ klienta"/>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Lp</th>
                    <th>Nazwa</th>
                    <th>Edytuj</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @if($clientTypes->isNotEmpty())
                @foreach($clientTypes as $clientType)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $clientType->getName() }}</td>
                        <td>
                            <a href="{{ route('admin.client-types.edit', ['id' => $clientType->id]) }}">
                                <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj typ klienta"/>
                            </a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
                @else
                <tr>
                  <td colspan="3">Brak danych do wyświetlenia</td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
