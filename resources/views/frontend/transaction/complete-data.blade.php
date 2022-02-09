@extends('frontend.layout.master')

@section('content')
    <div class="col-md-8 mx-auto my-5">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Nie wypełniłeś wszystkich danych</h2>
            </div>
            <div class="card-body">
                Musisz uzupełnić dane o swoim koncie oraz dodać konta bankowe. <br/>
                Ustawienia konta > Dane firmy <br/>
                Ustawienia konta > Reprezentant <br/>
                Środki > konta bankowe <br/> <br/>
                Aby aktywować konto skontaktuj się z administratorem, możemy od Ciebie wymagać informacji
                potwierdzających tożsamość.
            </div>
        </div>
    </div>
@endsection
