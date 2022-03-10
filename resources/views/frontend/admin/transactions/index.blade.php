@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Tranzakcje</h1>
<hr />
@if(session()->has('successalert'))
<div class="alert alert-success">
  <h1>Zmiany zostały zapisane</h1>
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
<div class="mx-auto">
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Lp</th>
          <th>Zleceniodawca</th>
          <th>Wykonawca</th>
          <th>Nazwa banku</th>
          <th>Waluta</th>
          <th>Nazwa</th>
          <th>Płacący</th>
          <th>Kwota</th>
          <th>Zapłacono</th>
          <th>Status</th>
          <th>Od:</th>
          <th>Do:</th>
          <th>Edytuj</th>
        </tr>
      </thead>
      <tbody>
        <?php
        use App\Models\Currency;
        use App\Models\ClientData;
        use App\Models\CompanyData;
        use App\Models\User;

        $i = 1; ?>
        @if($transactions->isNotEmpty())
        @foreach($transactions as $transaction)
        <?php
        $user1 =  User::where('id', $transaction['customer_id'])->first();
        $user2 =  User::where('id', $transaction['contractor_id'])->first();
        if ($user1['client_type_id'] == 1) {
            $customer =  ClientData::where('user_id', $transaction['customer_id'])->first();
        } else {
            $customer =  CompanyData::where('user_id', $transaction['customer_id'])->first();
        }

        if ($user2['client_type_id'] == 1) {
            $contractor =  ClientData::where('user_id', $transaction['contractor_id'])->first();
        } else {
            $contractor =  CompanyData::where('user_id', $transaction['contractor_id'])->first();
        }

        $currency = Currency::where('id', $transaction['currency_id'])->first();

         ?>
        <tr>
          <td>{{ $i }}</td>
          <td>{{$user1['username']}}: {{ $customer['name'] }} {{ $customer['surname'] }}</td>
          <td>{{$user2['username']}}: {{ $contractor['name'] }} {{ $contractor['surname'] }}</td>
          <td>{{ $transaction['bank_name'] }}</td>
          <td>{{ $currency['symbol'] }} - {{ $currency['name'] }}</td>
          <td>{{ $transaction['name'] }}</td>
          <td>{{ $transaction['commission_payer'] }}</td>
          <td>{{ $transaction['amount'] }}</td>
          <td>{{ $transaction['payment'] }}</td>
          <td>{{ $transaction['status'] }}</td>
          <td>{{ $transaction['from_date'] }}</td>
          <td>{{ $transaction['to_date'] }}</td>
          <td>
            <a href="{{ route('admin.transactions.edit', ['id' => $transaction->id]) }}">
              <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj Kraj" />
            </a>
          </td>
        </tr>
        <?php $i++ ?>
        @endforeach
        @else
        <tr>
          <td colspan="13">Brak danych do wyświetlenia</td>
        </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection
