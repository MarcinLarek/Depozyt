@extends('frontend.layout.master')

@section('content')
@elseif(session()->has('nomoneyerror1'))
<div class="alert alert-success">
  <h1>Nie posiadasz wystarczającej ilości środków aby zaakceptować tą zmiane</h1>
</div>
@elseif(session()->has('nomoneyerror2'))
<div class="alert alert-success">
  <h1>Nie można zaakceptować zmian poniewać zleceniodawca nie ma wpłaconych żadnych środków na platformie.</h1>
</div>
@elseif(session()->has('nomoneyerror3'))
<div class="alert alert-success">
  <h1>Nie można zaakceptować zmian poniewać wykonawca nie ma wpłaconych żadnych środków na platformie.</h1>
</div>
@endif
    <h1 class="mt-md-4" style="font-size: 350%;">{{ __('transaction.IND-title') }}</h1>
    <hr/>
    <div class="card border-0">
        <div class="card-body">
            <div class="row">
              <div class="col-3">
                <a href="{{ route('transaction') }}"><button class="btn btn-primary btn-sm" name="create">{{ __('transaction.IND-transaction-list') }}</button></a>
              </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form id="list-filter" method="post">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="client-type" class="control-label"></label>
                                <select name="client_type" id="client-type" class="custom-select">
                                    <option value="CU" selected>{{ __('transaction.IND-customer') }}</option>
                                    <option value="CO">{{ __('transaction.IND-contractor') }}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="from-date" class="control-label"></label>
                                <input name="from_date" id="from-date" class="form-control" placeholder="{{ __('transaction.IND-fromdate') }}"
                                       readonly="readonly"
                                       type="text"/>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="to-date" class="control-label"></label>
                                <input name="to_date" id="to-date" class="form-control" placeholder="{{ __('transaction.IND-todate') }}"
                                       readonly="readonly"
                                       type="text"/>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="expression" class="control-label"></label>
                                <input name="expression" id="expression" class="form-control" placeholder="{{ __('transaction.IND-serach') }}"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="tran-list"></div>
        </div>
    </div>
  @csrf
  <table class="table table-bordered table-hover table-responsive table-striped d-md-table">
      <thead>
      <tr class="text-center">
          <th>
              {{ __('transaction.TABLE-nr') }}
          </th>
          <th>
            {{ __('transaction.TABLE-details') }}
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
              {{ __('transaction.TABLE-tpye') }}
          </th>
          <th>
            {{ __('transaction.TABLE-customer-confirmation') }}
          </th>
          <th>
            {{ __('transaction.TABLE-contractor-confirmation') }}
          </th>
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
      $user1 =  User::where('id',$transaction['customer_id'])->first();
      $user2 =  User::where('id',$transaction['contractor_id'])->first();
      if ($user1['client_type_id'] == 1) {
        $customer =  ClientData::where('user_id',$transaction['customer_id'])->first();
      }
      else {
        $customer =  CompanyData::where('user_id',$transaction['customer_id'])->first();
      }

      if ($user2['client_type_id'] == 1) {
        $contractor =  ClientData::where('user_id',$transaction['contractor_id'])->first();
      }
      else {
        $contractor =  CompanyData::where('user_id',$transaction['contractor_id'])->first();
      }

      $currency = Currency::where('id',$transaction['currency_id'])->first();
       ?>
          <tr class="text-center">
              <td>
                  {{$i}}
              </td>
              <td>
                <a href="{{ route('transactions.preview', ['id' => $transaction->id]) }}"><img src="{{ asset('/images/eye.svg') }}" style="height:30px;width:30px" /></a>
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
                  @if($transaction->transaction_type === 1)
                    {{ __('transaction.TABLE-services') }}
                  @elseif($transaction->transaction_type === 2)
                    {{ __('transaction.TABLE-general-goods') }}
                  @else
                    {{ __('transaction.TABLE-brokerage') }}
                  @endif
              </td>
              @if($transaction['customer_accept'] === 1)
                <td class="table-success">
                    {{ __('transaction.TABLE-accepted') }}
                </td>
              @elseif($transaction['customer_accept'] === 0)
                <td class="table-danger">
                    {{ __('transaction.TABLE-not-accepted') }}
                  @if($transaction['customer_id'] == $currentuser['id'])
                    <br/><a href="{{ route('transactions.confirm', ['id' => $transaction->id]) }}"><button class="btn btn-link" type="submit">{{ __('transaction.TABLE-click-to-accept') }}</button> </a>
                  @endif
                </td>
              @endif

              @if($transaction['contractor_accept'] === 1)
                <td class="table-success">
                  {{ __('transaction.TABLE-accepted') }}
                </td>
              @elseif($transaction['contractor_accept'] === 0)
                <td class="table-danger">
                  {{ __('transaction.TABLE-not-accepted') }}
                    @if($transaction['contractor_id'] == $currentuser['id'])
                      <br/><a href="{{ route('transactions.confirm', ['id' => $transaction->id]) }}"><button class="btn btn-link" type="submit">{{ __('transaction.TABLE-click-to-accept') }}</button> </a>
                    @endif
                </td>
              @endif
          </tr>
          @if($transaction['status']=='Completed')
          <tr class="table-warning font-weight-bold text-center">
            <td colspan='13'>
              Obecny status transackji wynosi: {{$transaction['status']}}. Potwierdzając zmiany kończysz transakcje.
            </td>
          </tr>
          @endif
          <?php $i++ ?>
      @endforeach
      @else
      <tr class="text-center">
        <td colspan="13"> {{ __('transaction.TABLE-emptytoaccpet') }} </td>
      </tr>
      @endif
      </tbody>
  </table>
@endsection
