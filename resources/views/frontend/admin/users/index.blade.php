@extends('frontend.layout.master-dashboard')

@section('content')
    <h4>Użytkownicy</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Nazwa</th>
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
            @if($users->isNotEmpty())
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>

                    <td>{{ $user->username }}</td>

                    @if(isset($user->clientData['name']))
                    <td>{{ $user->clientData['name'] }} {{ $user->clientData['surname'] }}</td>
                    @else
                    <td>Nie wypełniono danych</td>
                    @endif

                    <td>{{ $user->clientType->name }}</td>
                    @if(isset($user->clientData['name']))
                    {{ $user->clientData['street'] }} {{ $user->clientData['post_code'] }} {{ $user->clientData['city'] }}
                    @else
                    <td>Nie wypełniono danych</td>
                    @endif

                    <td>{{ $user->email }}</td>
                    @if(isset($user->clientData['name']))
                    <td>{{ $user->clientData['phone'] }}</td>
                    @else
                    <td>Nie wypełniono danych</td>
                    @endif

                    <td>{{ $user->registrationDate() }}</td>

                    <td>
                        <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}">
                            <img src="{{ asset('/images/edit.svg') }}"  alt="Edytuj"/>
                        </a>
                    </td>

                </tr>
            @endforeach
            @else
            <tr>
              <td colspan="9">Brak danych do wyświetlenia</td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
