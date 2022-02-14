@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Konta Bankowe</h1>
    <hr/>
    @if(isset($success) && $success)
        <div class="col-md-12 mt-md-2">
            <div id="successAlert" class="alert alert-success d-none">
                <strong>UDAŁO SIĘ!</strong> Twoje dane zostały zapisane.<br/><strong>Sprawdź
                    skrzynkę pocztową z linkiem aktywacyjnym.</strong>
            </div>
        </div>
    @endif
    @if(isset($success) && !$success)
        <div class="col-md-12 mt-md-2">
            <div id="invalidAlert" class="alert alert-danger d-none">
                <strong>UPS... Coś poszło nie tak!</strong> Twoje dane nie zostały zapisane.
            </div>
        </div>
    @endif
    <div class="w-50 mx-auto">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Lp</th>
                    <th>Użytkownik</th>
                    <th>Nazwa</th>
                    <th>Nazwa Banku</th>
                    <th>Waluta</th>
                    <th>Kraj</th>
                    <th>Numer Konta</th>
                    <th>Swift</th>
                    <th>Aktywny</th>
                    <th>Edytuj</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  use App\Models\Currency;
                  use App\Models\User;
                  use App\Models\Country;
                  $i = 1; ?>
                  @foreach($banks as $bank)
                  <?php
                  $currency = Currency::where('id',$bank['currency_id'])->first();
                  $country = Country::where('id',$bank['country_id'])->first();
                  $user =  User::where('id',$bank['user_id'])->first();

                   ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $user['username'] }}</td>
                        <td>{{ $bank['name'] }}</td>
                        <td>{{ $bank['bank_name'] }}</td>
                        <td>{{ $currency['symbol'] }} - {{ $currency['name'] }}</td>
                        <td>{{ $country['country_name'] }}</td>
                        <td>{{ $bank['account_number'] }}</td>
                        <td>{{ $bank['swift'] }}</td>
                        <td>{{ $bank['active'] }}</td>
                        <td>
                            <a href="{{ route('admin.bankaccounts.edit', ['id' => $bank->id]) }}">
                                <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj Bank"/>
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
