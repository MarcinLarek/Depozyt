@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('payment.IND-title') }}</h1>
<hr />
@if(session()->has('autherror'))
<div class="alert alert-danger">
  <h1>{{ __('alerts.autherror') }}</h1>
</div>
@endif
<ul class="nav nav-tabs bg-white">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#searchTab"> {{ __('payment.IND-menu1') }}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#amountTab"> {{ __('payment.IND-menu2') }} </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#historyTab"> {{ __('payment.IND-menu3') }} </a>
  </li>
</ul>
<div id="myTabContent" class="tab-content bg-white">
  <div class="tab-pane fade show active" id="searchTab">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card  border-0">
          <div class="card-body">
            <h4 class="card-title">{{ __('payment.IND-menu1') }}</h4>

            <form id="getData" action="{{route('payment.getData')}}" method="post">
              @csrf
              <fieldset>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="bank-name" class="control-label">{{ __('payment.IND-bank-account') }}</label>
                    <select name="bank_name" id="bank-name" class="custom-select">
                      @foreach(Auth::user()->bankAccounts as $bank)
                      <option>{{ $bank->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="currency_id" class="control-label">{{ __('payment.IND-currency') }}</label>
                    <select name="currency_id" class="custom-select">
                      @foreach($currencies as $currency)
                      <option value="{{ $currency->id }}">{{ $currency->symbol }} - {{ $currency->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <input type="submit" value="Zatwierdź" class="btn btn-primary" />
              </fieldset>
            </form>

            <div class="row pt-3">
              @if(isset($selectedcurrency))
              <div class="col">
                <div class="row">
                  <h2 class="w-100">{{ __('payment.IND-transfer-details') }}</h2>
                  <div class="row">
                    <div class="col-3">
                      <p> <b>{{ __('payment.IND-transfer-title') }}:</b> </p>
                    </div>
                    <div class="col">
                      <p style="word-break: break-all;">{{$user['personal_code']}}_{{ $selectedcurrency['symbol'] }}</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-3">
                      <p> <b>{{ __('payment.IND-account-number') }}:</b> </p>
                    </div>
                    <div class="col">
                      <p>{{ $platformbank['account_number'] }}</p>
                      <p style="color:red"><b>{{ __('payment.IND-warning1') }}!</b> {{ __('payment.IND-warning2') }}</p>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <h2 class="w-100">{{ __('payment.IND-receiver') }}:</h2>
                  <div class="col-3 ">
                    <p> <b>{{ __('payment.IND-name') }}:</b> </p>
                    <p> <b>{{ __('payment.IND-nip') }}:</b> </p>
                    <p> <b>{{ __('payment.IND-regon') }}:</b> </p>
                    <p> <b>{{ __('payment.IND-krs') }}:</b> </p>
                    <p> <b>{{ __('payment.IND-street') }}:</b> </p>
                    <p> <b>{{ __('payment.IND-city') }}:</b> </p>
                  </div>
                  <div class="col">
                    <p>{{$data['company']}}</p>
                    <p>{{$data['nip']}}</p>
                    <p>{{$data['regon']}}</p>
                    <p>{{$data['krs']}}</p>
                    <p>{{$data['street']}}</p>
                    <p>{{$data['city']}}</p>
                  </div>
                </div>
              </div>
              @else
              <div class="col">
                <div class="row">
                  <h2>Wybierz walute i konto bankowe aby wyświetlić dane do przelewu</h2>
                </div>
              </div>
              @endif
              <div class="col">
                <?php
                                use App\Models\Currency;

?>
                <h2>{{ __('payment.IND-wallet-ammount') }}:</h2>
                @foreach(Auth::user()->wallet as $wallet)
                <?php
                                $currency = Currency::where('id', $wallet['currency_id'])->first();
                                 ?>
                <h5>
                  {{$wallet -> amount}} {{$currency['symbol']}} {{$currency['name']}}
                </h5>
                @endforeach
              </div>

            </div>

            <div class="row">
              <div class="col-md-12 mb-md-2">
                <div id="progressBar" class="progress d-none">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span id="progressText"></span></div>
                </div>
              </div>
              <div id="payment" class="col-md-12 mb-md-2"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="historyTab">
    <div class="col-sm-12 col-md-8 offset-md-2 pt-2">
      <h4 class="card-title"> {{ __('payment.IND-menu3') }} </h4>
      @include('/frontend/payment/get-history')
    </div>
    <div id="history"></div>
  </div>
  <div class="tab-pane fade" id="amountTab">
    <div class="col-sm-12 col-md-8 offset-md-2 pt-2">
      <h4 class="card-title"> {{ __('payment.IND-menu2') }} </h4>

    </div>
    <div id="amountHistory"></div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/js/payment.min.js') }}"></script>
@endsection
