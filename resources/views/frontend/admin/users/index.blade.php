@extends('frontend.layout.master-dashboard')

@section('content')
    <h4>Użytkownicy</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Imię i nazwisko</th>
                <th>Typ konta</th>
                <th>Adres</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Data rejestracji</th>
                <th>Opcje</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->clientData['name'] }} {{ $user->clientData['surname'] }}</td>
                    <td>{{ $user->clientType->name }}</td>
                    <td>{{ $user->clientData['street'] }} {{ $user->clientData['post_code'] }} {{ $user->clientData['city'] }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->clientData['phone'] }}</td>
                    <td>{{ $user->registrationDate() }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">
                            <img src="{{ asset('/images/edit.svg') }}"  alt="Edytuj"/>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
