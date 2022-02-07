@extends('frontend.layout.master')
@section('content')
    <h1 class="mt-md-4">{{ __('clientbankaccounts.IND-title') }}</h1>
    <hr/>
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title">{{ __('clientbankaccounts.IND-your-bank-accounts') }}</h4>
            <p>
                <a href="{{ route('bank-accounts.create') }}">{{ __('clientbankaccounts.IND-add') }}</a>
            </p>
            <table class="table table-bordered table-hover table-responsive table-striped d-md-table">
                <thead>
                <tr class="text-center">
                    <th>
                        {{ __('clientbankaccounts.IND-nr') }}
                    </th>
                    <th>
                        {{ __('clientbankaccounts.IND-name') }}
                    </th>
                    <th>
                        {{ __('clientbankaccounts.IND-currency') }}
                    </th>
                    <th>
                        {{ __('clientbankaccounts.IND-bank') }}
                    </th>
                    <th>
                        {{ __('clientbankaccounts.IND-account-number') }}
                    </th>
                    <th>
                        {{ __('clientbankaccounts.IND-swift') }}
                    </th>
                    <th>
                        {{ __('clientbankaccounts.IND-active') }}
                    </th>
                    <th>
                      {{ __('clientbankaccounts.IND-edit') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @if ($bankAccounts->count() > 0)
                    @foreach ($bankAccounts as $account)
                        <tr>
                            <td class="text-right">
                                {{ $i }}
                            </td>
                            <td class="text-left">
                                {{ $account->getName() }}
                            </td>
                            <td class="text-center">
                                {{ $account->getCurrencyName() }}
                            </td>
                            <td class="text-center">
                                {{ $account->getBankName() }}
                            </td>
                            <td class="text-right">
                                {{ $account->getAccountNumber() }}
                            </td>
                            <td class="text-center">
                                {{ $account->getSwift() }}
                            </td>
                            @if ($account->isActive())
                                <td class="text-center">
                                    <img src="{{ asset('/images/active.svg') }}" alt="Aktywuj konto"/>
                                </td>
                            @else
                                <td class="text-center">
                                    <img src="{{ asset('/images/deactive.svg') }}" alt="Dezaktywuj konto"/>
                                </td>
                            @endif
                            <td class="text-center">
                                <a href="{{ route('bank-accounts.edit', ['id' => $account->id]) }}">
                                    <img src="{{ asset('images/edit.svg') }}" alt="Edytuj konto"/></a>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center font-weight-bold">
                            {{ __('clientbankaccounts.IND-noaccounts-1') }}<a href="{{ route('bank-accounts.create') }}">{{ __('clientbankaccounts.IND-noaccounts-2') }}</a>{{ __('clientbankaccounts.IND-noaccounts-3') }}
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
