@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Edytuj tranzakcje - <strong>{{ $transaction['name']}}</strong></h1>
    <hr/>
    <form method="post" action="{{ route('admin.transactions.update', ['id' => $transaction->id]) }}" class="w-50 mx-auto">
        @csrf
        @method('PUT')

        <form id="Create" action="{{ route('admin.transactions.store', ['id' => $transaction->id]) }}" asp-controller="Transaction" method="post">
          @csrf
            <fieldset>
                <div class="row">
                  <div class="form-group col-md-6">
                      <label for="customer_id" class="control-label">Zleceniodawca </label>
                      <select name="customer_id" class="custom-select">
                        @foreach($users as $user)
                          @if( $user['client_type_id'] === 1)
                            <option>{{$user['username']}}</option>
                          @endif
                        @endforeach
                      </select>
                  </div>
                  <div class="form-group col-md-6">
                      <label for="contractor_id" class="control-label">Wykonawca </label>
                      <select name="contractor_id" class="custom-select">
                        @foreach($currencies as $currency)
                          @if( $user['client_type_id'] === 2)
                            <option>{{$user['username']}}</option>
                          @endif
                        @endforeach
                      </select>
                  </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-6">
                        <label for="Name"
                               class="control-label">Nazwa tranzakcji</label>
                        <input name="Name" class="form-control"
                               value="{{$transaction['name']}}"/>
                    </div>
                    <div class="form-group col-md-6">
                        <label
                            for="TransactionType">Typ tranzakcji</label>
                        <select id="TransactionType" name="TransactionType"
                                class="custom-select">
                            <option value="1">Usługi kontraktowe</option>
                            <option value="2">Towary ogólne</option>
                            <option value="3">Pośrednictwo</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="FromDate" class="control-label">Od:</label>
                        <input name="FromDate" class="form-control" value="{{$transaction['from_date']}}"
                                type="date"/>
                        <span asp-validation-for="FromDate" class="text-danger"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ToDate" class="control-label">Do:</label>
                        <input name="ToDate" class="form-control" value="{{$transaction['to_date']}}"
                              type="date"/>
                        <span asp-validation-for="ToDate" class="text-danger"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="CommissionPayer">Płacący: </label>
                        <select name="CommissionPayer" class="custom-select">
                            <option value="principal">Zleceniodawca</option>
                            <option value="contractor">Wykonawca</option>
                            <option value="half">Pół na poł</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="BankName" class="control-label">Nazwa Banku</label>
                        <select name="BankName" class="custom-select">
                          @foreach($banks as $bank)
                              <option>{{ $bank->bank_name }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="CurrencyName" class="control-label">Waluta </label>
                        <select name="CurrencyName" class="custom-select">
                          @foreach($currencies as $currency)
                              <option>{{ $currency->symbol }}</option>
                          @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="Amount" class="control-label">Kwota</label>
                        <input name="Amount" class="form-control" value="{{$transaction['amount']}}"/>
                        <span asp-validation-for="Amount" class="text-danger"></span>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="payment" class="control-label">Zapłacono</label>
                        <input name="Payment" class="form-control" value="{{$transaction['payment']}}"/>
                        <span asp-validation-for="payment" class="text-danger"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="Description" class="control-label">Opis</label>
                        <textarea asp-for="Description" class="form-control" name="description" placeholder="Opis"
                                  cols="80" rows="3"></textarea>
                        <span asp-validation-for="Description" class="text-danger"></span>
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
                        <strong>UDAŁO SIĘ!</strong> Twoje dane zostały zapisane.<br/><strong>Sprawdź
                            skrzynkę pocztową z wiadomością potwierdzającą zawarcie usługi
                            depozytowej.</strong>
                    </div>
                </div>
                <div class="col-md-12 mt-md-2">
                    <div id="invalidAlert" class="alert alert-danger d-none">
                        <strong>UPS... Coś poszło nie tak!</strong> Twoje dane nie zostały
                        zapisane.
                    </div>
                </div>
            </div>
        </form>

    </form>
@endsection
