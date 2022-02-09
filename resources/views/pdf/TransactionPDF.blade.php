<!DOCTYPE HTML>
<html lang="pl">
<head>
<meta charset = "UTF-8">
</head>
<body>
        <div class="date">
            <div> Data wystawienia: {{$mytime}} </div>
        </div>
        <div class="row">
          <h1> Potwierdzenie dokonania wpłaty </h1>
        </div>
        <div class="row">
          <div class="col-2">
            <b>Przez:</b>
          </div>
          <div class="col">
            <p>{{ $usercustomerdata['name'] }} {{ $usercustomerdata['surname'] }}  </p>
            <p>{{ $usercustomerdata['post_code'] }} {{ $usercustomerdata['city'] }} </p>
            <p>{{ $usercustomerdata['street'] }} </p>
          </div>
        </div>

        <div class="row">
          <div class="col-2">
            <b>Szczegóły:</b>
          </div>
          <div class="col">
            <p>Nazwa: {{ $transaction['name'] }}</p>
            <p>Kwota:  {{ $transaction['amount'] }} {{ $transaction['symbol'] }} {{ $currency['name'] }}</p>
          </div>
        </div>

        <div class="row">
          <h4> Odbiorca </h4>
          <p>{{ $platformdata['company'] }}</p>
          <p>{{ $platformdata['city'] }}</p>
          <p>{{ $platformdata['street'] }}</p>
        </div>
</body>
</html>
