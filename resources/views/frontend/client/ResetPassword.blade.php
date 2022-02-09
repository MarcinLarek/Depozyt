@extends('frontend.layout.master')

@section('content')
<h1 class="mt-md-4">{{ __('client.RES-title') }}</h1>
<hr />
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card border-0">
            <div class="card-body">
                <h4 class="card-title">{{ __('client.IND-subtitle') }}</h4>
                <form id="Reset" asp-action="ResetPassword" asp-controller="Client" method="post">
                    <input name="Email" type="hidden" />
                    <input name="Token" type="hidden" />
                    <fieldset>
                        <div class="row align-items-center justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="UserPassword" class="control-label"></label><a class="alert-link" data-toggle="modal" href="#myModal"><img class="ml-2" src="~/Images/info.svg" title="Wymogi dotyczące hasła." /></a>
                                <input name="UserPassword" class="form-control" placeholder="{{ __('client.IND-password') }}" />
                                <span asp-validation-for="UserPassword" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="CofirmPassword" class="control-label"></label>
                                <input name="CofirmPassword" class="form-control" placeholder="{{ __('client.RES-password_repeat') }}" />
                                <span asp-validation-for="CofirmPassword" class="text-danger"></span>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="form-group col-md-12 text-center mt-md-4">
                            <input type="submit" value="{{ __('client.IND-save') }}" class="btn btn-primary" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-md-2">
                            <div id="progressBar" class="progress d-none">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span id="progressText"></span></div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-md-2">
                            <div id="successAlert" class="alert alert-success d-none">
                                {{ __('client.IND-succes') }}
                            </div>
                        </div>
                        <div class="col-md-12 mt-md-2">
                            <div id="invalidAlert" class="alert alert-danger d-none">
                                {{ __('client.IND-failure') }}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section Scripts {
    @{await Html.RenderPartialAsync("ValResetPasswordScripts/_ValResetPasswordScriptsPartial");}
}
