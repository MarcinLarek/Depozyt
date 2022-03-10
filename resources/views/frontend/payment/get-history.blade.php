<table class="table table-bordered table-hover table-responsive table-striped d-md-table">
  <?php
use Illuminate\Support\Facades\Auth;

$walletHistory = Auth::user()->walletHistory()->get();
   ?>
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
      <th>
        {{ __('payment.TAB-date') }}
      </th>
      <th>
        {{ __('payment.TAB-download') }}
      </th>
    </tr>
  </thead>
  <tbody>
    @if($walletHistory->count() > 0 )
    @foreach ($walletHistory as $wallet)
    @if($wallet->amount > 0)
    <tr>
      <td class="text-left">
        {{ $wallet->bank_name }}
      </td>
      <td class="text-left">
        {{ $wallet->currency->getSymbol() }} - {{ $wallet->currency->getName() }}
      </td>
      <td class="text-left">
        {{ $wallet->amount }}
      </td>
      <td class="text-center">
        {{ $wallet->created_at }}
      </td>
      <td class="text-center">
        <a href="{{ route('payment.download', [$wallet->id]) }}">
          <img src="{{ asset('/images/document.svg') }}" style="cursor: pointer;" alt="Pobierz potwierdzenie wpłaty" />
        </a>
      </td>
    </tr>
    @endif
    @endforeach
    @else
    <tr class="text-center font-weight-bold">
      <td colspan="6">
        {{ __('payment.TAB-nomoney') }}
      </td>
    </tr>
    @endif
  </tbody>
</table>

<div id="generatingPDF" class="d-none text-center p-2">
  Generowanie PDF...
</div>
