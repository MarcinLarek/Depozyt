@extends('frontend.layout.master')

@section('content')
    <h1 class="mt-md-4">{{ __('payment.IND-title') }}</h1>
    <hr/>
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
                            <form id="Search" asp-action="GetData" asp-controller="Payment" method="post">
                                <fieldset>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="bank-name" class="control-label">{{ __('payment.IND-bank-account') }}:</label>
                                            <select name="bank_name" id="bank-name" class="custom-select">
                                                @foreach(Auth::user()->bankAccounts as $bank)
                                                    <option>{{ $bank->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="CurrencyName" class="control-label">{{ __('payment.IND-currency') }}</label>
                                            <select name="CurrencyName" class="custom-select">
                                              @foreach($currencies as $currency)
                                                  <option>{{ $currency->symbol }}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>

                            <div class="row">

                              <div class="col">
                                <div class="row">
                                  <h2 class="w-100" >{{ __('payment.IND-transfer-details') }}:</h2>
                                  <div class="col-2">
                                      <p> <b>{{ __('payment.IND-transfer-title') }}:</b> </p>
                                      <p> <b>{{ __('payment.IND-account-number') }}:</b> </p>
                                  </div>
                                  <div class="col">
                                      <p>kontoPlaceholder</p>
                                      <p>nrPlaceholder</p>
                                      <p style="color:red"><b>{{ __('payment.IND-warning1') }}!</b> {{ __('payment.IND-warning2') }}</p>
                                  </div>
                                </div>
                                <div class="row">
                                  <h2 class="w-100" >{{ __('payment.IND-receiver') }}:</h2>
                                  <div class="col-2">
                                      <p> <b>{{ __('payment.IND-name') }}:</b> </p>
                                      <p> <b>{{ __('payment.IND-nip') }}:</b> </p>
                                      <p> <b>{{ __('payment.IND-regon') }}:</b> </p>
                                      <p> <b>{{ __('payment.IND-krs') }}:</b> </p>
                                      <p> <b>{{ __('payment.IND-street') }}:</b> </p>
                                      <p> <b>{{ __('payment.IND-city') }}:</b> </p>
                                  </div>
                                  <div class="col">
                                      <p>Depozyt</p>
                                      <p>1234567890</p>
                                      <p>1234567890</p>
                                      <p>1234567890</p>
                                      <p>XXX</p>
                                      <p>XXX</p>
                                  </div>
                                </div>
                              </div>

                              <div class="col">
                                <h2>{{ __('payment.IND-wallet-ammount') }}:</h2>
                                @foreach(Auth::user()->wallet as $wallet)
                                <h5>{{$wallet -> amount}}
                                  @if($wallet->currency_id === 1)
                                  PLN-Polski Złoty
                                  @endif
                                </h5>
                                @endforeach
                              </div>

                            </div>



                            <div class="row">
                                <div class="col-md-12 mb-md-2">
                                    <div id="progressBar" class="progress d-none">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                             role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                             aria-valuemax="100"
                                             style="width: 100%"><span id="progressText"></span></div>
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
