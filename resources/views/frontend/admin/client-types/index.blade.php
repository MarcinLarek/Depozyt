@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Kraje</h1>
    <hr/>
    @if(isset($success) && $success == 1)
        <div class="col-md-12 mt-md-2">
            <div id="successAlert" class="alert alert-success d-none">
                <strong>UDAŁO SIĘ!</strong> Dodano typ klienta.
            </div>
        </div>
    @endif
    @if(isset($success) && $success == 0)
        <div class="col-md-12 mt-md-2">
            <div id="invalidAlert" class="alert alert-danger d-none">
                <strong>UPS... Coś poszło nie tak!</strong> Twoje dane nie zostały zapisane.
            </div>
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
                    <label for="name">{{ __('account.client-type') }}</label>
                    <input type="text" name="name" id="name" class="form-control"
                           placeholder="{{ __('account.client-type') }}">
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
                </tbody>
            </table>
        </div>
    </div>
@endsection
