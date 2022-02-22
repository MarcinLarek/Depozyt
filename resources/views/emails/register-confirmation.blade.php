@component('mail::message')
<h2>{{ __('mail.REG-thanks') }}</h2>
<p>
{{ __('mail.REG-click') }}
<a href="{{ route('register.confirmation', $uservar->personal_code, ['token' => $uservar->personal_code])  }}">{{ __('mail.REG-here') }}</a>
{{ __('mail.REG-rest') }}
</p>

@endcomponent
