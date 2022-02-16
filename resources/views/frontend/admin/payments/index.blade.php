@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Wpłaty</h1>
    <hr/>
    @if($succesaalert == 1)
    <div class="alert alert-success">
      <h1>{{ __('alerts.data_save_success') }}</h1>
    </div>
    @endif
    <div class="w-50 mx-auto">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Lp</th>
                    <th>Użytkownik</th>
                    <th>Nazwa Banku</th>
                    <th>Waluta</th>
                    <th>Kwota</th>
                    <th>Id dokumentu</th>
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
                @if($history->isNotEmpty())
                @foreach($history as $payment)
                <?php
                $user =  User::where('id',$payment['user_id'])->first();
                $normaluser =  ClientData::where('user_id',$user['id'])->first();
                $companyuser =  CompanyData::where('user_id',$user['id'])->first();
                $currency = Currency::where('id',$payment['currency_id'])->first();
                 ?>
                    @if($payment['amount'] >= 0)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>
                          @if($normaluser != null)
                          {{ $user['username'] }}: {{$normaluser['name']}} {{$normaluser['surname']}}
                          @else
                          {{ $user['username'] }}: {{$companyuser['name']}}
                          @endif
                        </td>
                        <td>{{ $payment['bank_name'] }}</td>
                        <td>{{ $currency['symbol'] }} - {{ $currency['name'] }}</td>
                        <td>{{ $payment['amount'] }}</td>
                        <td>{{ $payment['generated_document_id'] }}</td>
                        <td>
                            <a href="{{ route('admin.payments.edit', ['id' => $payment->id]) }}">
                                <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj Kraj"/>
                            </a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                    @endif
                @endforeach
                @else
                <tr>
                  <td colspan="7">Brak danych do wyświetlenia</td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
