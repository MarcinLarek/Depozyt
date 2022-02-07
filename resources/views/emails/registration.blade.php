<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <style>
        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        body {
            margin: 0;
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 0.9rem;
            font-weight: 100;
            line-height: 2;
            color: #222;
            text-align: center;
            background-color: #fff;
        }

        a {
            color: #008cba;
            text-decoration: none;
            background-color: transparent;
        }

            a:hover {
                color: #00526e;
                text-decoration: underline;
            }

        .text-left {
            text-align: left !important;
            border-left: solid .5px black;
            width: 50%;
            padding-left: 1%;
        }

        .text-right {
            text-align: right !important;
            width: 49%;
            padding-right: 1%;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        table {
            max-width: 650px;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .footer-font-size {
            font-size: 0.7rem;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td colspan="2" style="font-size: 200%; margin-top: 1em;">
                {{ config('app.name') }}
            </td>
        </tr>
        <tr style="height: 20px">
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">Witaj, <strong>{{ $user->username }}</strong></td>
        </tr>
        <tr style="height: 20px">
            <td></td>
            <td></td>
        </tr>
        <tr class="text-center">
            <td> Dziękujemy za rejestrację na platformie Depozyt.com!</td>
        </tr>
        <tr>
            <td colspan="2">
                Od aktywacji konta dzieli Cię już tylko jedno <a href="{{ config('app.url') }}/confirm-email">kliknięcie</a>.
            </td>
        </tr>
        <tr style="height: 20px">
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center">System wygenerował dla Ciebie unikatowy kod klienta potrzebny do zawierania umów na platformie.<br /><strong>Zachowaj go i nie udostępniaj nikomu nieupoważnionemu.</strong></td>
        </tr>
        <tr>
            <td colspan="2" class="font-weight-bold text-center">{{ $user->displayPersonalCode() }}</td>
        </tr>
        @include('emails.footer')
    </table>
</body>
</html>
