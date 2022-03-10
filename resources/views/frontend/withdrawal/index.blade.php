@extends('frontend.layout.master')

@section('content')
<?php
use App\Models\Currency;

?>
<h1 class="mt-md-4">{{ __('withdrawal.IND-title') }}</h1>
<hr />
@if(session()->has('successalert'))
<div class="alert alert-success">
  <h1>{{ __('alerts.data_save_success') }}</h1>
</div>
@elseif(session()->has('nomoney'))
<div class="alert alert-danger">
  <h1>{{ __('withdrawal.IND-nomoney') }}</h1>
</div>
@endif
<ul class="nav nav-tabs bg-whlass="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#withdrawalTab"> {{ __('withdrawal.IND-menu1') }} </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#historyTab"> {{ __('withdrawal.IND-menu2') }} </a>
  </li>
</ul>
<div id="myTabContent" class="tab-content bg-white">
  <div class="tab-pane fade active show" id="withdrawalTab">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <?php
        $bankAccounts = Auth::user()->bankAccounts;
        $temp = count($bankAccounts);
        $wallets = Auth::user()->wallets;
        $temp2 = count($bankAccounts);
         ?>
        @if($temp < 1 && $temp2 < 1) <div id="warningAlert">
          <h4 class="alert-heading">{{ __('withdrawal.IND-alert') }}!</h4>
          <p class="mb-0">{{ __('withdrawal.IND-alertdesc') }}</p>
      </div>
      @else
      <div id="withdrawal" class="card border-0">
        <div class="card-body">
          <h4 class="card-title">{{ __('withdrawal.IND-withdraw') }}</h4>
          <form method="post" action="{{ route('withdrawal.store') }}">
            @csrf
            <fieldset>
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="bank_name" class="control-label">{{ __('withdrawal.IND-bank-account') }}</label>
                  <select name="bank_name" class="custom-select">
                    @foreach(Auth::user()->bankAccounts as $bank)
                    <option>{{ $bank->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="currency_id" class="control-label">{{ __('withdrawal.IND-currency') }}</label>
                  <select name="currency_id" class="custom-select">
                    @foreach($currencies as $currency)
                    <option value="{{ $currency->id }}">{{ $currency->symbol }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row justify-content-center">
                <div class="col">
                  <h5><strong>{{ __('withdrawal.IND-avaliable-ammount') }}</strong></h5>
                  @foreach(Auth::user()->wallet as $wallet)
                  <?php
                  $currency = Currency::where('id', $wallet['currency_id'])->first();
                  ?>
                  <h5>{{$wallet -> amount}} {{$currency['symbol']}} {{$currency['name']}}</h5>
                  @endforeach
                </div>
              </div>
              <div class="row align-items-center justify-content-center mb-md-3">
                <span id="AvailableAmount" name="AvailableAmount"></span>
              </div>
              <div class="row">

                <div class="form-group col-md-6">
                  <label for="amount" class="control-label">{{ __('withdrawal.IND-amount') }}</label>
                  <input name="amount" id="amount" class="form-control" placeholder="{{ __('withdrawal.IND-amount') }}" value="{{ old('amount') }}" />
                  <span asp-validation-for="Amount" class="text-danger"></span>
                </div>
              </div>
            </fieldset>
            <div class="row">
              <div class="form-group col-md-12 text-center mt-md-4">
                <input type="submit" value="{{ __('withdrawal.IND-save') }}" class="btn btn-primary" />
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-md-2">
                <div id="progressBar" class="progress d-none">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span id="progressText"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-12 mt-md-2">
                <div id="successAlert" class="alert alert-success d-none">
                  {{ __('withdrawal.IND-succes') }}
                </div>
              </div>
              <div class="col-md-12 mt-md-2">
                <div id="invalidAlert" class="alert alert-danger d-none">
                  {{ __('withdrawal.IND-failure') }}
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
<div id="historyTab" class="tab-pane fade">
  <div class="col-sm-12 col-md-8 offset-md-2 pt-2">
    <h4 class="card-title"> Historia wypłat </h4>
  </div>
  <div id="history"></div>
</div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/js/withdrawal.min.js') }}"></script>
@endsection
