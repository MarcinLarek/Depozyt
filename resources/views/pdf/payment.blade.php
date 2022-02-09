<style>
    .date {
        margin-top: 5mm;
        width: 30%;
        margin-left: auto;
        text-align: center;
        font-weight: 200;
    }

    table {
        width: 100%;
        height: auto;
    }

    th, td {
        width: 50%;
    }

    tr {
        margin-bottom: 2em;
    }

    .line {
        height: 2px;
        background: black;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    .text-align-left {
        text-align: left;
    }

    #content {
        padding-top: 3.5em;
        width: 100%;
    }
</style>

<div id="content">
    <div class="line"></div>
    <div class="date">
        <div> Data wystawienia: {{ date('Y-m-d') }}</div>
    </div>
    <h2> Potwierdzenie dokonania wpłaty na platformę </h2>
    <table>
        <tr>
            <th>
                Przez:
            </th>
            <td>
                <div>{{ $payment->user->clientData->name }} {{ $payment->user->clientData->surname }}</div>
                <div>{{ $payment->user->clientData->post_code }} {{ $payment->user->clientData->city }}</div>
                <div>{{ $payment->user->clientData->street }}</div>
            </td>
        </tr>
        <tr>
            <th>
                Szczegóły:
            </th>
            <td colspan="2">
                <b> Kwota: </b> {{ $payment->amount }} {{ $payment->currency->getSymbol() }} <br/>
                <h4>Odbiorca</h4>
                <b>{{ $platformData->company }}</b> <br/>
                {{ $platformData->street }}<br/>
                {{ $platformData->city }}
            </td>
        </tr>
    </table>
</div>
