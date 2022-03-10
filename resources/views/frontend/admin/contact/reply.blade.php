@extends('frontend.layout.master-dashboard')

@section('content')
<h1>Odpowiedz: {{$contact->email}}</h1>
<hr />
<div class="w-50 mx-auto">
  <div class="">
    <form id="Reply" action="{{ route('admin.contact.sendreply', ['id' => $contact->id]) }}" method="post">
      @csrf
      <fieldset>

        <div class="row align-items-center justify-content-center">
          <label for="message" class="control-label">
            <h2>Twoja Odpowiedź</h2>
          </label>
          <textarea name="message" id="message" class="form-control" placeholder="Twoja odpowiedź">{{ old('message') }}</textarea>

          <span asp-validation-for="Email" class="text-danger"></span>
        </div>
      </fieldset>
      <div class="row">
        <div class="form-group col-md-12 text-center mt-md-4">
          <input type="submit" value="Wyślij" class="btn btn-primary" />
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
