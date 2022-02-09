@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Edytuj konto bankowe - <strong>{{ $bankAccount->bank_name }} - {{ $bankAccount->currency->getName() }}</strong></h1>
    <hr />
    @if(isset($success) && $success)
        <div class="col-md-12 mt-md-2">
            <div id="successAlert" class="alert alert-success d-none">
                <strong>UDAŁO SIĘ!</strong> Twoje dane zostały zapisane.
            </div>
        </div>
    @endif
    @if(isset($success) && !$success)
        <div class="col-md-12 mt-md-2">
            <div id="invalidAlert" class="alert alert-danger d-none">
                <strong>UPS... Coś poszło nie tak!</strong> Twoje dane nie zostały zapisane.
            </div>
        </div>
    @endif
    <div class="col-md-6 mx-auto">
        <form method="post" action="{{ route('admin.platform-bank-account.update', ['id' => $bankAccount->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group col-md-8 mx-auto">
                <label for="account-number">{{ __('bank-account.account-number') }}</label>
                <input type="text" name="account_number" id="account-number" class="form-control"
                       placeholder="{{ __('bank-account.account-number') }}" value="{{ old('account_number', $bankAccount->account_number) }}">
            </div>
            <div class="form-group col-md-8 mx-auto">
                <label for="bank_name">{{ __('bank-account.bank-name') }}</label>
                <input type="text" name="bank_name" id="bank_name" class="form-control"
                       placeholder="{{ __('bank-account.bank-name') }}" value="{{ old('account_number', $bankAccount->bank_name) }}">
            </div>
            <div class="form-group col-md-8 mx-auto">
                <label for="currency-id" class="control-label">{{ __('bank-account.currency') }}</label>
                <select name="currency_id" id="currency-id" class="custom-select">
                    <option value="">{{ __('bank-account.select-currency') }}</option>
                    @foreach(\App\Models\Currency::getActiveCurrency() as $currency)
                        <option value="{{ $currency->id }}" @if($bankAccount->currency_id == $currency->id) selected @endif>{{ $currency->symbol }} - {{ $currency->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-8 mx-auto">
                <label for="active" class="control-label">{{ __('bank-account.active') }}</label>
                <select name="active" id="active" class="custom-select">
                    <option value="1" @if ($bankAccount->isActive()) selected @endif>Tak</option>
                    <option value="0" @if (!$bankAccount->isActive()) selected @endif>Nie</option>
                </select>
            </div>
            <div class="row py-3">
                <input type="submit" class="btn btn-primary mx-auto" value="Edytuj konto bankowe"/>
            </div>
        </form>
    </div>
@endsection
