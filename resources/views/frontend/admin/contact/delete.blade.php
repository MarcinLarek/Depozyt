@extends('frontend.layout.master-dashboard')
@section('content')
    <hr/>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card  border-0">
                <div class="card-body">
                    <h1 class="card-title text-center">Czy napewno chcesz usunąć tą wiadomość?</h1>
                    <form id="delete" action="{{ route('admin.contact.deletemessege', ['id' => $contact->id]) }}" method="post">
                      @csrf
                          <div class="row ">
                            <div class="col-3">

                            </div>
                            <div class="col-2">
                              <h3>ID: </h3>
                              <h3>Od: </h3>
                              <h3>Data wysłania: </h3>
                            </div>
                            <div class="col-4">
                              <h3>{{$contact->id}}</h3>
                              <h3>{{$contact->email}}</h3>
                              <h3>{{$contact->created_at}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 text-center mt-md-4">
                                <input type="submit" value="Usuń" class="btn btn-danger"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-md-2">
                                <div id="progressBar" class="progress d-none">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                         role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 100%"><span id="progressText"></span></div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-md-2">
                                <div id="successAlert" class="alert alert-success d-none">
                                    <strong>UDAŁO SIĘ!</strong> Twoje dane zostały zapisane.<br/><strong>Sprawdź
                                        skrzynkę pocztową z linkiem aktywacyjnym.</strong>
                                </div>
                            </div>
                            <div class="col-md-12 mt-md-2">
                                <div id="invalidAlert" class="alert alert-danger d-none">
                                    <strong>UPS... Coś poszło nie tak!</strong> Twoje dane nie zostały zapisane.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Uwagi dotyczące hasła</h5>
                    <button class="close" aria-label="Close" type="button" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Hasło musi składać się przynajmniej z jednego znaku specjalnego, wielkich lub małych liter oraz
                        cyfr.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
