<table class="table table-bordered table-hover table-responsive table-striped d-md-table">
    <thead>
    <tr class="text-center">
        <th>
            Lp
        </th>
        <th>
            Nazwa
        </th>
        <th>
            Wykonawca
        </th>
        <th>
            Waluta
        </th>
        <th>
            Od
        </th>
        <th>
            Do
        </th>
        <th>
            Kwota
        </th>
        <th>
            Wpłata
        </th>
        <th>
            Opis
        </th>
        <th>
            Status
        </th>
        <th>
            Pobierz dokument
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($transactions as $transaction)
        <tr>
            <td class="text-right">
                placeholder
            </td>
            <td class="text-left">
                {{$transaction->name}}
            </td>
            <td class="text-left">
                {{$transaction->customer_id}}
            </td>
            <td class="text-center">
                {{$transaction->currency_id}}
            </td>
            <td class="text-right">
                {{$transaction->from_date}}
            </td>
            <td class="text-right">
                {{$transaction->to_date}}
            </td>
            @if (item.Payment < item.Amount)
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
            <td class="text-left">
                @Html.DisplayFor(modelItem => item.Description)
            </td>
            <td class="text-center">
                <a href="Payment/@item.Id" title="Opłać usługę depozytową."><i class="fa fa-credit-card"
                                                                               style="font-size: 20px;"
                                                                               aria-hidden="true"></i></a>
            </td>
            <td class="text-center">
                Brak dokumentów
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<h5>Legenda</h5>
<p>
    <i class="fa fa-credit-card" style="font-size: 20px;" aria-hidden="true"></i> - Opłać usługę depozytową.
</p>
<p>
    <img src="{{ asset('/images/accept.svg') }}" /> - zaakceptuj realizację umowy.
</p>
<p>
    <img class="inProgress" src="{{ asset('/images/inProgress.svg') }}" /> - Umowa nie jest jeszcze opłacona ani efekt realizacji
    zaakceptowany.
</p>
<p>
    <img src="{{ asset('/images/complete.svg') }}" /> - Transakcja jest opłacona oraz jej rezultat jest zaakceptowany. Możesz
    pobrać dokument podsumowujący usługę depozytową.
</p>
<p>
    <img src="{{ asset('/images/document.svg') }}" /> - Pobierz dokument PDF z podsumowaniem usługi depozytowej.
</p>
<div id="generatingPDF" class="d-none text-center p-2">
    Generowanie PDF...
</div>
