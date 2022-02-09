@component('mail::message')
<h2>Kliknij tutaj aby zalogować się do panelu admina</h2>
<?php $userid = $uservar['id'] ?>
<a href="{{ route('admin.AdminLogin', $uservar->token, ['token' => $uservar->token])  }}"> <button type="button" class="btn btn-primary">Zaloguj się</button> </a>
@endcomponent
