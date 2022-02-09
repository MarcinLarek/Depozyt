<table class="table table-bordered table-hover table-responsive table-striped d-md-table">
    <thead>
      <?php
      use Illuminate\Support\Facades\Auth;
      use App\Models\User;
      use App\Models\Payment;
      use App\Models\ClientData;
            $user = Auth::user();
            $payments = Payment::where('user_id',$user['id'])->get();
       ?>
    <tr class="text-center">
        <th>
            {{ __('recipient.HIS-account_number') }}
        </th>
        <th>
            {{ __('recipient.HIS-recipient') }}
        </th>
        <th>
            {{ __('recipient.HIS-name') }}
        </th>
        <th>
            {{ __('recipient.HIS-ammount') }}
        </th>

    </tr>
    </thead>
    <tbody>
    @if($payments->count() > 0 )
        @foreach ($payments as $payment)
        <?php
        $recipient =  User::where('id',$payment['recipient_id'])->first();
        $recipientdata =  ClientData::where('user_id',$recipient['id'])->first();
         ?>
        @if($payment->amount > 0)
            <tr>
                <td class="text-left">
                    {{ $payment['account_number']}}
                </td>
                <td class="text-left">
                    {{ $recipientdata['name']}} {{ $recipientdata['surname']}}
                </td>
                <td class="text-left">
                    {{ $payment['payment_title']}}
                </td>
                <td class="text-center">
                    {{ $payment['payment_title']}}
                </td>

            </tr>
            @endif
        @endforeach
    @else
        <tr class="text-center font-weight-bold">
            <td colspan="6">
                {{ __('recipient.HIS-nomoney') }}
            </td>
        </tr>
    @endif
    </tbody>
</table>

<div id="generatingPDF" class="d-none text-center p-2">
    {{ __('recipient.HIS-pdf') }}
</div>
