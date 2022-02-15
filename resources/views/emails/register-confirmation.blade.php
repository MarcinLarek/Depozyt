@component('mail::message')
<h2>Dziękujemy za rejestracje w aplikacji Depozyt.com</h2>
<p>
Kliknij
<a href="{{ route('register.confirmation', $uservar->personal_code, ['token' => $uservar->personal_code])  }}">tutaj</a>
, aby potwierdzić rejestracje.
</p>

@endcomponent
