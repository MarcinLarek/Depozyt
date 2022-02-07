@extends('frontend.layout.master-dashboard')

@section('content')
    <h4>Administratorzy</h4>
    <hr/>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Id</th>
                <th>Imię i nazwisko</th>
                <th>Email</th>
                <th>Data rejestracji</th>
                <th>Opcje</th>
            </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name}} {{$admin->surname}}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.admins.edit', ['id' => $admin->id]) }}">
                            <img src="{{ asset('/images/edit.svg') }}"  alt="Edytuj"/>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
