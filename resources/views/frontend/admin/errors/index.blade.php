@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Wyjątki</h1>
    <hr/>
<div class="w-75 mx-auto">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Lp</th>
                    <th>Data</th>
                    <th>Controller</th>
                    <th>Metoda</th>
                    <th>ID użytkownika</th>
                    <th>IP</th>
                    <th>Wiadomość</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($errors as $error)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $error['date'] }}</td>
                        <td>{{ $error['controller'] }}</td>
                        <td>{{ $error['method'] }}</td>
                        <td>{{ $error['user_id'] }}</td>
                        <td>{{ $error['client_ip'] }}</td>
                        <td>{{ $error['message'] }}</td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
