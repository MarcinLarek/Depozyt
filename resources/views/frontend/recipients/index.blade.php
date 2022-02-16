@extends('frontend.layout.master')

@section('content')
    <h1 class="mt-md-4">{{ __('recipient.IND-title') }}</h1>
    <hr/>
    @if($succesaalert == 1)
    <div class="alert alert-success">
      <h1>{{ __('alerts.data_save_success') }}</h1>
    </div>
    @endif
    <div class="card border-0">
        <div class="card-body">
            <h4 class="card-title">{{ __('recipient.IND-subtitle') }}</h4>
            <p>
                <a href="{{ route('recipients.create') }}">{{ __('recipient.IND-add') }}</a>
            </p>
            <table class="table table-bordered table-hover table-responsive table-striped d-md-table">
                <thead>
                <tr class="text-center">
                    <th>
                        {{ __('recipient.IND-nr') }}
                    </th>
                    <th>
                        {{ __('recipient.IND-recipient_name') }}
                    </th>
                    <th>
                        {{ __('recipient.IND-account_number') }}
                    </th>
                    <th>
                        {{ __('recipient.IND-city') }}
                    </th>
                    <th>
                        {{ __('recipient.IND-street') }}
                    </th>
                    <th>
                        {{ __('recipient.IND-postcode') }}
                    </th>
                    <th>
                        {{ __('recipient.IND-active') }}
                    </th>
                    <th>
                        {{ __('recipient.IND-edit') }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @if($recipients->count() > 0)
                    @foreach ($recipients as $recipient)
                        <tr>
                            <td class="text-right">
                                {{ $i }}
                            </td>
                            <td class="text-left">
                                {{ $recipient->name }}
                            </td>
                            <td class="text-left">
                                {{ $recipient->getAccountNumber() }}
                            </td>
                            <td class="text-left">
                                {{ $recipient->getCity() }}
                            </td>
                            <td class="text-left">
                                {{ $recipient->getStreet() }}
                            </td>
                            <td class="text-center">
                                {{ $recipient->getPostCode() }}
                            </td>
                            @if($recipient->isActive())
                                <td class="text-center">
                                    <img src="{{ asset('/images/active.svg') }}"/>
                                </td>
                            @else
                                <td class="text-center">
                                    <img src="{{ asset('/images/deactive.svg')}}"/>
                                </td>
                            @endif
                            <td class="text-center">
                                <a href="{{ route('recipients.edit', ['id' => $recipient->id]) }}">
                                    <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj"/>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center font-weight-bold">
                        <td colspan="8">{{ __('recipient.IND-norecipient1') }} <a
                            href="{{ route('recipients.create') }}">{{ __('recipient.IND-norecipient2') }}</a>{{ __('recipient.IND-norecipient3') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
