@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Konta Bankowe</h1>
<hr />
@if(session()->has('successalert'))
<div class="alert alert-success">
  <h1>Zmiany zostały zapisane</h1>
</div>
@endif
<div class="mx-auto">
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
        @if($banks->isNotEmpty())
        @foreach($banks as $bank)
        <?php
        $currency = Currency::where('id', $bank['currency_id'])->first();
        $country = Country::where('id', $bank['country_id'])->first();
        $user =  User::where('id', $bank['user_id'])->first();

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
          @if($bank['active'] == 1)
          <td>Tak</td>
          @else
          <td>Nie</td>
          @endif
          <td>
            <a href="{{ route('admin.bankaccounts.edit', ['id' => $bank->id]) }}">
              <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj Bank" />
            </a>
          </td>
        </tr>
        <?php $i++ ?>
        @endforeach
        @else
        <tr>
          <td colspan="10">Brak danych do wyświetlenia</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection
