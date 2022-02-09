@component('mail::message')
<h2>Dziękujemy za rejestracje w aplikacji Depozyt.com</h2>
<p>
Kliknij
<a href="{{ route('register.confirmation', $uservar->token, ['token' => $uservar->token])  }}">tutaj</a>
, aby potwierdzić rejestracje.
</p>

@endcomponent
