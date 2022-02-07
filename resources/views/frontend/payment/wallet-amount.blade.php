<table class="table table-bordered table-hover table-responsive table-striped d-md-table">
    <thead>
    <tr class="text-center">
        <th>
            {{ __('payment.TAB-bank') }}
        </th>
        <th>
            {{ __('payment.TAB-currency') }}
        </th>
        <th>
            {{ __('payment.TAB-amount') }}
        </th>
    </tr>
    </thead>
    <tbody>
    @if ($wallet->count() > 0)
        @foreach ($wallet as $amount)
            <tr class="table">
                <td class="text-left">

                </td>
                <td class="text-left">
                    @if($amount->currency_id === 1)
                    PLN-Polski Złoty
                    @endif
                    @if($amount->currency_id === 2)
                    $-Dollar Amerykański
                    @endif
                </td>
                <td class="text-left">
                    {{ $amount->amount }}
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="3" class="text-center font-weight-bold">
                {{ __('payment.TAB-nomoney') }}
            </td>
        </tr>
    @endif
    </tbody>
</table>
