@extends('frontend.layout.master')

@section('content')
<div class="row mt-5">
    <h1 class="mx-auto font-weight-bold text_color">{{ __('home.HowItWorks-title') }}<a href ="{{ route('home') }}">{{ __('home.depositlink') }}</a>?</h1>
</div>
<div class="col-md-8 mx-auto">
    <div class="row mt-4">
        <div class="col-12 col-md-4">
            <img class="img-fluid" src="/Images/home-how-it-works/1.png" />
        </div>
        <div class="col-12 col-md-8 description">
            <div>
                <h2 class="mt-md-2 text-left font-weight-bold text_color text-uppercase">{{ __('home.HIW-image-one-title') }}</h2>
                <p class="text_color">{{ __('home.HIW-image-one-desc') }}</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-md-8 description">
            <div>
                <h2 class="mt-md-2 text-left font-weight-bold text_color">{{ __('home.HIW-image-two-title') }}</h2>
                <p class="text_color">
                    {{ __('home.HIW-image-two-desc') }}
                </p>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <img class="img-fluid" src="/Images/home-how-it-works/2.jpg" />
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-md-4">
            <img class="img-fluid" src="/Images/home-how-it-works/3.png" />
        </div>
        <div class="col-12 col-md-8 description">
            <div>
                <h2 class="mt-md-2 text-left font-weight-bold text_color">{{ __('home.HIW-image-three-title') }}</h2>
                <p class="text_color">{{ __('home.HIW-image-three-desc') }}</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-md-8 description">
            <div>
                <h2 class="mt-md-2 text-left font-weight-bold text_color">{{ __('home.HIW-image-four-title') }}</h2>
                <p class="text_color">
                    {{ __('home.HIW-image-four-desc') }}
                </p>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <img class="img-fluid" src="/Images/home-how-it-works/4.png" />
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-md-4">
            <img class="img-fluid" src="/Images/home-how-it-works/5.png" />
        </div>
        <div class="col-12 col-md-8 description">
            <div>
                <h2 class="mt-md-2 text-left font-weight-bold text_color">{{ __('home.HIW-image-five-title') }}</h2>
                <p class="text_color">
                    {{ __('home.HIW-image-five-desc') }}
                </p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 col-md-8 description">
            <div>
                <h2 class="mt-md-2 text-left font-weight-bold text_color">{{ __('home.HIW-image-six-title') }}</h2>
                <p class="text_color">
                    {{ __('home.HIW-image-six-desc') }}
                </p>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <img class="img-fluid" src="/Images/home-how-it-works/6.png" />
        </div>
    </div>
</div>

<style>
    .description {
        display: flex;
        flex-flow: column;
        justify-content: space-around;
    }
</style>
@endsection
