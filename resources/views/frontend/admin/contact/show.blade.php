@extends('frontend.layout.master-dashboard')

@section('content')
    <h1>Wiadomość</h1>
    <hr/>
    <div class="w-50 mx-auto">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th> <h1>Od: {{$contact->email}}</h1> </th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $contact->message }}</td>
                    </tr>
                    <tr>
                      <td>Wysłano: {{ $contact->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col">
              <a href="{{ route('admin.contact.reply', ['id' => $contact->id]) }}"><button type="button" class="btn btn-success" name="button">Odpowiedz</button></a>
            </div>
            <div class="col text-right">
              <a href="{{ route('admin.contact.delete', ['id' => $contact->id]) }}"><button type="button" class="btn btn-danger" name="button">Usuń wiadomość</button></a>
            </div>
        </div>
    </div>
@endsection
