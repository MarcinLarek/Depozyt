@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4" style="font-size: 350%;">{{ __('transaction.IND-title') }}</h1>
<hr />
<?php
    use App\Models\Currency;
    use App\Models\ClientData;
    use App\Models\CompanyData;
    use App\Models\User;

    $i = 1; ?>
@if(session()->has('successalert'))
<div class="alert alert-success">
  <h1>{{ __('alerts.data_save_success') }}</h1>
</div>
@endif
@if(session()->has('autherror'))
<div class="alert alert-danger">
  <h1>{{ __('alerts.autherror') }}</h1>
</div>
@endif
@if(isset($user->clientData['name']) || isset($user->companyData['name']))
<div class="card border-0">
  <div class="card-body">
    <div class="row">

      <div class="col-2">
        <a href="{{ route('transaction.create') }}"><button class="btn btn-primary btn-sm" name="create">{{ __('transaction.IND-add-transaction') }}</button></a>
      </div>

      <div class="col-3">
        <a href="{{ route('transaction.transactionsToAccept') }}"><button class="btn btn-primary btn-sm" name="create">{{ __('transaction.IND-view-changes') }}</button></a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <form action="{{ route('transactions.filter')}}" method="post">
          @csrf
          <div class="row">
            <div class="form-group col-md-3">
              <label for="client-type" class="control-label"></label>
              <select name="client_type" id="client-type" class="custom-select">
                <option value="CU" selected>{{ __('transaction.IND-customer') }}</option>
                <option value="CO">{{ __('transaction.IND-contractor') }}</option>
                <option value="AN">{{ __('transaction.IND-any') }}</option>
              </select>
            </div>
            <div class="form-group col-md-3">
              <label for="from-date" class="control-label"></label>
              <input name="from_date" id="from_date" class="form-control" placeholder="{{ __('transaction.IND-fromdate') }}" type="date" value="{{ old('from_date') }}" />
            </div>
            <div class="form-group col-md-3">
              <label for="to-date" class="control-label"></label>
              <input name="to_date" id="to_date" class="form-control" placeholder="{{ __('transaction.IND-todate') }}" type="date" value="{{ old('to_date') }}" />
            </div>
            <div class="form-group col-md-3">
              <label for="expression" class="control-label"></label>
              <input name="serach" id="serach" class="form-control" placeholder="{{ __('transaction.IND-serach') }}" value="{{ old('serach') }}" />
            </div>
          </div>
          <input type="submit" value="{{ __('transaction.IND-filtr') }}" class="btn btn-primary" />
        </form>
      </div>
    </div>
    <div id="tran-list"></div>
  </div>
</div>
<table class="table table-bordered table-hover table-responsive table-striped d-md-table">
  <thead>
    <tr class="text-center">
      <th>
        {{ __('transaction.TABLE-nr') }}
      </th>
      <th>
        {{ __('transaction.TABLE-name') }}
      </th>
      <th>
        {{ __('transaction.TABLE-customer') }}
      </th>
      <th>
        {{ __('transaction.TABLE-contractor') }}
      </th>
      <th>
        {{ __('transaction.TABLE-currency') }}
      </th>
      <th>
        {{ __('transaction.TABLE-from') }}
      </th>
      <th>
        {{ __('transaction.TABLE-to') }}
      </th>
      <th>
        {{ __('transaction.TABLE-amount') }}
      </th>
      <th>
        {{ __('transaction.TABLE-payment') }}
      </th>
      <th>
        {{ __('transaction.TABLE-description') }}
      </th>
      <th>
        {{ __('transaction.TABLE-tpye') }}
      </th>
      <th>
        {{ __('transaction.TABLE-status') }}
      </th>
      <th>
        {{ __('transaction.TABLE-download-document') }}
      </th>
      <th>
        {{ __('transaction.TABLE-edit') }}
      </th>
    </tr>
  </thead>
  <tbody>

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
    <tr class="text-center">
      <td>
        {{$i}}
      </td>
      <td>
        {{$transaction->name}}
      </td>
      <td>
        {{$user1['username']}}: {{ $customer['name'] }} {{ $customer['surname'] }}
      </td>
      <td>
        {{$user2['username']}}: {{ $contractor['name'] }} {{ $contractor['surname'] }}
      </td>
      <td>
        {{ $currency['symbol'] }} - {{ $currency['name'] }}
      </td>
      <td>
        {{$transaction->from_date}}
      </td>
      <td>
        {{$transaction->to_date}}
      </td>
      @if ($transaction->payment < $transaction->amount)
        <td class="text-right table-danger">
          {{$transaction->amount}}
        </td>
        <td class="text-right table-danger">
          {{$transaction->payment}}
        </td>
        @else
        <td class="text-right table-success">
          {{$transaction->amount}}
        </td>
        <td class="text-right table-success">
          {{$transaction->payment}}
        </td>
        @endif
        <td>
          {{$transaction->description}}
        </td>
        <td>
          @if($transaction->transaction_type === 1)
          {{ __('transaction.TABLE-services') }}
          @elseif($transaction->transaction_type === 2)
          {{ __('transaction.TABLE-general-goods') }}
          @else
          {{ __('transaction.TABLE-brokerage') }}
          @endif
        </td>
        <td>
          {{$transaction->status}}
        </td>
        <td>
          <a href="{{ route('transactions.generatepdf2', ['id' => $transaction->id]) }}"><img src="{{ asset('/images/document.svg') }}" /></a>
        </td>
        @if($transaction->status=='Completed')
        <td>
          {{$transaction->status}}
        </td>
        @else
        <td>
          <a href="{{ route('transactions.edit', ['id' => $transaction->id]) }}">
            <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj tranzakcję" />
          </a>
        </td>
        @endif
    </tr>
    <?php $i++ ?>
    @if($transaction->payment >= $transaction->amount && $transaction->status != 'Completed')
    <tr class="text-center font-weight-bold">
      <td colspan="14"> <a class="text-dark" href="{{ route('transactions.complete', ['id' => $transaction->id]) }}">Zakończ Transakcje {{$transaction->name}}</a> </td>
    </tr>
    @endif
    @endforeach
    @else
    <tr class="text-center">
      <td colspan="14"> {{ __('transaction.TABLE-empty') }} </td>
    </tr>
    @endif
  </tbody>
</table>

<h5>{{ __('transaction.IND-legend') }}</h5>
<p>
  <i class="fa fa-credit-card" style="font-size: 20px;" aria-hidden="true"></i>{{ __('transaction.IND-legend-pay') }}
</p>
<p>
  <img src="{{ asset('/images/accept.svg') }}" />{{ __('transaction.IND-legend-accept') }}
</p>
<p>
  <img class="inProgress" src="{{ asset('/images/inProgress.svg') }}" />{{ __('transaction.IND-legend-notpayed-notaccepted') }}
</p>
<p>
  <img src="{{ asset('/images/complete.svg') }}" />{{ __('transaction.IND-legend-payed-notaccepted') }}
</p>
<p>
  <img src="{{ asset('/images/document.svg') }}" />{{ __('transaction.IND-legend-downloadpdf') }}
</p>
<div id="generatingPDF" class="d-none text-center p-2">
  {{ __('transaction.IND-pdf') }}
</div>

@else
<div class="alert alert-danger">
  <h1>{{ __('transaction.IND-nodata') }}</h1>
</div>
@endif
@endsection
