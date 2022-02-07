@extends('frontend.layout.master-dashboard')

@section('content')
    <h1 class="mt-md-4">Logowanie</h1>
    <hr/>
    <div clasms="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-0">
                <div class="card-body">
                    <h4 class="card-title">Zaloguj się</h4>
                    <form action="{{ route('admin.login') }}" method="post">
                        @csrf
                        <fieldset>
                            <div class="row align-items-center justify-content-center">
                                <div class="form-group col-md-6">
                                    <label for="username" class="control-label">{{ __('account.username') }}</label>
                                    <input name="username" id="username" class="form-control" placeholder="{{ __('account.username') }}"/>
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center">
                                <div class="form-group col-md-6">
                                    <label for="password" class="control-label">{{ __('account.password') }}</label>
                                    <input name="password" id="password" class="form-control" type="password" placeholder="{{ __('account.password') }}"/>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <div class="row">
                            <div class="form-group col-md-12 text-center mt-md-4">
                                <input type="submit" value="Zaloguj" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/login.min.js') }}"></script>
@endsection
