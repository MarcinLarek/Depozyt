@extends('frontend.layout.master')
@section('content')
    <h1 class="mt-md-4">{{ __('transaction.CRE-title') }}</h1>
    <hr/>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="col-md-8 offset-md-2">
        <div class="card border-0">
            <div class="card-body">
                <h4 class="card-title">{{ __('transaction.CRE-give-data') }}</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <form id="search" action="{{route('transactions.get-contractor')}}" method="post">
                                    @csrf
                                    <fieldset>
                                        <legend>{{ __('transaction.CRE-search-data') }}</legend>
                                        <div class="row align-items-center justify-content-center">
                                            <div class="form-group col-md-3">
                                                <label for="personal-code" class="control-label"></label>
                                                <input name="personal_code" id="personal-code" class="form-control"
                                                       placeholder="{{ __('transaction.CRE-code') }}"
                                                       value="{{ old('personal_code') }}"/>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                                <div class="row">
                                    <div class="col-md-12 mb-md-2">
                                        <div id="progressBar" class="progress d-none">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                 role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                 aria-valuemax="100" style="width: 100%"><span id="progressText"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="contractor" class="col-md-12 mb-md-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                              <form id="Create" action="{{ route('transactions.store') }}" asp-controller="Transaction" method="post">
                                @csrf
                                  <fieldset>
                                      <legend>{{ __('transaction.CRE-details') }}</legend>
                                      <div class="row">



                                        <input type="hidden" class="hidden" id="personal-code2" name="personal-code2" >
                                        <script type="text/javascript">
                                        window.onload = function() {
                                            var src = document.getElementById("personal-code"),
                                                dst = document.getElementById("personal-code2");
                                            src.addEventListener('input', function() {
                                                dst.value = src.value;
                                            });
                                        };
                                        </script>



                                          <div class="form-group col-md-6">
                                              <label for="name"
                                                     class="control-label">{{ __('transaction.TABLE-name') }}</label>
                                              <input name="name" id="name" class="form-control"
                                                     placeholder="{{ __('transaction.TABLE-name') }}"
                                                     value="{{ old('name') }}"/>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label
                                                  for="TransactionType">{{ __('transaction.TABLE-tpye') }}</label>
                                              <select id="transaction_type" name="transaction_type"
                                                      class="custom-select" value="{{ old('transaction_type') }}">
                                                  <option value="1">{{ __('transaction.TABLE-services') }}</option>
                                                  <option value="2">{{ __('transaction.TABLE-general-goods') }}</option>
                                                  <option value="3">{{ __('transaction.TABLE-brokerage') }}</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-6">
                                              <label for="from_date" id="from_date" class="control-label" value="{{ old('from_date') }}">{{ __('transaction.TABLE-from') }}:</label>
                                              <input name="from_date" class="form-control" placeholder="{{ __('transaction.TABLE-from') }}"
                                                      type="date" value="{{ old('from_date') }}"/>
                                              <span asp-validation-for="FromDate" class="text-danger"></span>
                                          </div>
                                          <div class="form-group col-md-6">
                                              <label for="to_date" class="control-label">{{ __('transaction.TABLE-to') }}:</label>
                                              <input name="to_date" id="to_date" class="form-control" placeholder="{{ __('transaction.TABLE-to') }}"
                                                    type="date" value="{{ old('to_date') }}"/>
                                              <span asp-validation-for="ToDate" class="text-danger"></span>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-12">
                                              <label for="commission_payer">{{ __('transaction.TABLE-payment-type') }}: </label>
                                              <select name="commission_payer" id="commission_payer" class="custom-select" value="{{ old('commission_payer') }}">
                                                  <option value="principal">{{ __('transaction.TABLE-customer') }}</option>
                                                  <option value="contractor">{{ __('transaction.TABLE-contractor') }}</option>
                                                  <option value="half">{{ __('transaction.TABLE-half') }}</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-4">
                                              <label for="bank_name" class="control-label">{{ __('transaction.TABLE-bank-name') }}</label>
                                              <select name="bank_name" id="bank_name" class="custom-select" placeholder="{{ __('transaction.TABLE-bank-name') }}" value="{{ old('bank_name') }}">
                                                @foreach(Auth::user()->bankAccounts as $bank)
                                                    <option>{{ $bank->bank_name }}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="currency_name" class="control-label">{{ __('transaction.TABLE-currency') }} </label>
                                              <select name="currency_name" id="bank_name" class="custom-select" value="{{ old('currency') }}">
                                                @foreach($currencies as $currency)
                                                    <option>{{ $currency->symbol }}</option>
                                                @endforeach
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="amount" class="control-label">{{ __('transaction.TABLE-ammount') }}</label>
                                              <input name="amount" class="form-control" placeholder="{{ __('transaction.TABLE-ammount') }}" value="{{ old('ammount') }}"/>
                                              <span asp-validation-for="Amount" class="text-danger"></span>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="form-group col-md-12">
                                              <label for="description" class="control-label">{{ __('transaction.TABLE-description') }}</label>
                                              <textarea asp-for="description" id="description" class="form-control" name="description" placeholder="{{ __('transaction.TABLE-description') }}"
                                                        cols="80" rows="3">{{ old('description') }}</textarea>
                                              <span asp-validation-for="description" class="text-danger"></span>
                                          </div>
                                      </div>
                                  </fieldset>
                                  <div class="row">
                                      <div class="form-group col-md-12 text-center mt-md-4">
                                          <input type="submit" value="Zapisz" class="btn btn-primary"/>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-12 mb-md-2">
                                          <div id="progressBar" class="progress d-none">
                                              <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                   role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                                   aria-valuemax="100" style="width: 100%"><span
                                                      id="progressText"></span></div>
                                          </div>
                                      </div>
                                      <div class="col-md-12 mt-md-2">
                                          <div id="successAlert" class="alert alert-success d-none">
                                            {{ __('transaction.CRE-succes') }}
                                          </div>
                                      </div>
                                      <div class="col-md-12 mt-md-2">
                                          <div id="invalidAlert" class="alert alert-danger d-none">
                                            {{ __('transaction.CRE-failure') }}
                                          </div>
                                      </div>
                                  </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <a href="{{ route('transaction') }}">Wróc do listy</a>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/transaction.min.js') }}"></script>
@endsection
