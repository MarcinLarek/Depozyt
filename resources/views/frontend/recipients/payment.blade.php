@extends('frontend.layout.master')

@section('content')
<?php use App\Models\Currency;

?>
<h1 class="mt-md-4">{{ __('recipient.PAY-title') }}</h1>
<hr />
@if(session()->has('successalert'))
<div class="alert alert-success">
  <h1>{{ __('alerts.data_save_success') }}</h1>
</div>
@endif
<ul class="nav nav-tabs bg-white">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#searchTab"> {{ __('recipient.PAY-menu1') }} </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#historyTab"> {{ __('recipient.PAY-menu2') }} </a>
  </li>
</ul>
<div id="myTabContent" class="tab-content bg-white">
  <div class="tab-pane fade show active" id="searchTab">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card  border-0">
          <div class="card-body">
            <h4 class="card-title">{{ __('recipient.PAY-subtitle') }}</h4>
            <div class="row">
              <div id="payment" class="col-md-12 mb-md-2"></div>
            </div>
            <form action="{{ route('payment.paymentpost') }}" method="post">
              @csrf
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="name" class="control-label">{{ __('recipient.PAY-recipient-name') }}</label>
                  <select name="recipment_id" id="name" class="custom-select">
                    @foreach($recipients as $recipient)
                    <option value="{{ $recipient->id }}">{{ $recipient->name }}</option>
                    @endforeach
                  </select>
                  @error('recipment_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-4">
                  <label for="payment-title" class="control-label">{{ __('recipient.PAY-payment-name') }}</label>
                  <input name="payment_title" id="payment-title" class="form-control" placeholder="{{ __('recipient.PAY-payment-name') }}" />
                  @error('payment_title')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-4">
                  <label for="currency" class="control-label">{{ __('recipient.PAY-currency') }}</label>
                  <select name="currency_id" id="currency" class="custom-select">
                    <?php
                                          $currencies = Currency::get();
                                           ?>
                    @foreach($currencies as $currency)
                    <option value="{{$currency['id']}}">{{$currency['symbol']}} {{$currency['name']}}</option>
                    @endforeach
                  </select>
                  @error('currency_id')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-4">
                  <label for="amount" class="control-label">{{ __('recipient.PAY-amount') }}</label>
                  <input name="amount" type="number" step=".01" class="form-control" placeholder="{{ __('recipient.PAY-amount') }}" />
                  @error('amount')
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="form-group col-md-12 text-center mt-md-4">
                  <input type="submit" value="{{ __('recipient.PAY-save') }}" class="btn btn-primary" />
                </div>
              </div>
            </form>
            @if(session()->has('walleterror'))
            <div class="row">
              <h5>{{ __('recipient.PAY-walleterror') }}</h5>
            </div>
            @endif
            <div class="row">
              <div class="col-md-12 mb-md-2">
                <div id="progressBar" class="progress d-none">
                  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span id="progressText"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-12 mt-md-2">
                <div id="successAlert" class="alert alert-success d-none">
                  {{ __('recipient.PAY-succes') }}
                </div>
              </div>
              <div class="col-md-12 mt-md-2">
                <div id="invalidAlert" class="alert alert-danger d-none">
                  {{ __('recipient.PAY-failure') }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="historyTab">
    <div class="col-sm-12 col-md-8 offset-md-2 pt-2">
      <h4 class="card-title"> {{ __('recipient.HIS-title') }} </h4>
      @include('/frontend/recipients/get-history')
    </div>
    <div id="history"></div>
  </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/js/withdrawal2.min.js') }}"></script>
@endsection
