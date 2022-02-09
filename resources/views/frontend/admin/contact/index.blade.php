@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Waluty</h1>
    <hr/>
    <div class="w-50 mx-auto">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Od</th>
                    <th>Data wysłania</th>
                    <th>Edytuj</th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.contact.show', ['id' => $contact->id]) }}">
                                <img src="{{ asset('/images/edit.svg')}}" alt="Edytuj Kraj"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
