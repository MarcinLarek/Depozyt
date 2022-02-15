@extends('frontend.layout.master')
@section('content')
<h1 class="mt-md-4" style="font-size: 350%;">{{ __('transaction.IND-title') }}</h1>
<hr/>
<div class="card border-0 pb-3">
    <div class="card-body">
        <div class="row">
          <div class="col-2">
            <a href="{{ route('transaction') }}"><button class="btn btn-primary btn-sm" name="create">{{ __('transaction.IND-transaction-list') }}</button></a>
          </div>
          <div class="col-3">
            <a href="{{ route('transaction.transactionsToAccept') }}"><button class="btn btn-primary btn-sm" name="create">{{ __('transaction.IND-view-changes') }}</button></a>
          </div>
        </div>
    </div>
</div>

<div class="container">
  <?php
  use App\Models\Currency;
  use App\Models\ClientData;
  use App\Models\CompanyData;
  use App\Models\User;
  $customer =  ClientData::where('user_id',$transaction['customer_id'])->first();
  $contractor =  CompanyData::where('user_id',$transaction['contractor_id'])->first();
  $currency = Currency::where('id',$transaction['currency_id'])->first();
  $user =  User::where('id',$transaction['customer_id'])->first();
  $user2 =  User::where('id',$transaction['contractor_id'])->first();
   ?>

  <div class="row pb-3">
    <div class="col-md-3">
        <div class="card text-center shadow">
          <div class="card-header">
            {{ __('transaction.TABLE-customer') }}
          </div>
            <div class="card-body">
              {{$user['username']}}: {{ $customer['name'] }} {{ $customer['surname'] }}
            </div>
        </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow">
        <div class="card-header">
          {{ __('transaction.TABLE-contractor') }}
        </div>
          <div class="card-body">
            {{$user2['username']}}: {{ $contractor['name'] }}
          </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow">
        <div class="card-header">
          {{ __('transaction.TABLE-name') }}
        </div>
          <div class="card-body">
            {{$transaction['name']}}
          </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow">
        <div class="card-header">
          {{ __('transaction.TABLE-bank-name') }}
        </div>
          <div class="card-body">
            {{$transaction['bank_name']}}
          </div>
      </div>
    </div>

  </div>

  <div class="row pb-3">
    <div class="col-md-3">
        <div class="card text-center shadow">
          <div class="card-header">
            {{ __('transaction.TABLE-currency') }}
          </div>
            <div class="card-body">
              {{ $currency['symbol'] }} - {{ $currency['name'] }}
            </div>
        </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow">
        <div class="card-header">
          {{ __('transaction.TABLE-payment-type') }}
        </div>
          <div class="card-body">
            {{$transaction['commission_payer']}}
          </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow">
        <div class="card-header">
          {{ __('transaction.TABLE-from') }}
        </div>
          <div class="card-body">
            {{$transaction['from_date']}}
          </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow">
        <div class="card-header">
        {{ __('transaction.TABLE-to') }}
        </div>
          <div class="card-body">
            {{$transaction['to_date']}}
          </div>
      </div>
    </div>

  </div>

  <div class="row pb-3">
    <div class="col-md-3">
        <div class="card text-center shadow">
          <div class="card-header">
            {{ __('transaction.TABLE-tpye') }}
          </div>
            @if($transaction['transaction_type'] == 1)
            <div class="card-body">
              Usługi kontraktowe
            </div>
            @elseif($transaction['transaction_type'] == 2)
            <div class="card-body">
              Towary ogólne
            </div>
            @elseif($transaction['transaction_type'] == 3)
            <div class="card-body">
              Pośrednictwo
            </div>
            @endif
        </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow">
        <div class="card-header">
          {{ __('transaction.TABLE-creation-date') }}
        </div>
          <div class="card-body">
            {{$transaction['date_of_order']}}
          </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow">
        <div class="card-header">
          {{ __('transaction.TABLE-ammount') }}
        </div>
          <div class="card-body">
            {{$transaction['amount']}}
          </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card text-center shadow">
        <div class="card-header">
        {{ __('transaction.TABLE-payment') }}
        </div>
          <div class="card-body">
            {{$transaction['payment']}}
          </div>
      </div>
    </div>

  </div>

  <div class="row pb-3 justify-content-center">
    <div class="card text-center shadow w-100">
      <div class="card-header">
        {{ __('transaction.TABLE-description') }}
      </div>
        <div class="card-body">
          {{$transaction['description']}}
        </div>
    </div>
  </div>



</div>

@endsection
