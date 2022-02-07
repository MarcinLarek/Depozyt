@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Konta bankowe platformy</h1>
    <hr/>
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
        <form method="post" action="{{ route('admin.platform-bank-account.store') }}">
            @csrf
            <div class="form-group col-md-8 mx-auto">
                <label for="account-number">{{ __('bank-account.account-number') }}</label>
                <input type="text" name="account_number" id="account-number" class="form-control"
                       placeholder="{{ __('bank-account.account-number') }}">
            </div>
            <div class="form-group col-md-8 mx-auto">
                <label for="bank_name">{{ __('bank-account.bank-name') }}</label>
                <input type="text" name="bank_name" id="bank_name" class="form-control"
                       placeholder="{{ __('bank-account.bank-name') }}">
            </div>
            <div class="form-group col-md-8 mx-auto">
                <label for="currency-id" class="control-label">{{ __('bank-account.currency') }}</label>
                <select name="currency_id" id="currency-id" class="custom-select">
                    <option value="">{{ __('bank-account.select-currency') }}</option>
                    @foreach(\App\Models\Currency::getActiveCurrency() as $currency)
                        <option value="{{ $currency->id }}">{{ $currency->symbol }} - {{ $currency->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-8 mx-auto">
                <label for="active" class="control-label">{{ __('bank-account.active') }}</label>
                <select name="active" id="active" class="custom-select">
                    <option value="1">Tak</option>
                    <option value="0">Nie</option>
                </select>
            </div>
            <div class="row py-3">
                <input type="submit" class="btn btn-primary mx-auto" value="Dodaj konto bankowe"/>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Lp</th>
                    <th>Nazwa banku</th>
                    <th>Numer konta</th>
                    <th>Waluta</th>
                    <th>Aktywne</th>
                    <th>Edytuj</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($bankAccounts as $bankAccount)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $bankAccount->bank_name }}</td>
                        <td>{{ $bankAccount->account_number }}</td>
                        <td>{{ $bankAccount->currency->symbol }} - {{ $bankAccount->currency->name }}</td>
                        <td class="text-center">
                            @if ($bankAccount->isActive())
                                <img src="{{ asset('/images/active.svg')}}" alt="Aktywne konto"/>
                            @else
                                <img src="{{ asset('/images/deactive.svg')}}" alt="Aktywne konto"/>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.platform-bank-account.edit', ['id' => $bankAccount->id]) }}">
                                <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj konto bankowe"/>
                            </a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
