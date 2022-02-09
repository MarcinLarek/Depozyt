@extends('frontend.layout.master')

@section('content')
    <div class="col-md-9 mx-auto mt-4">
        <h1>{{ __('home.WhatsIsDeposit-title') }}<a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a>?</h1>
        <p><strong>{{ __('home.bold-first-word') }}</strong>{{ __('home.first-paragraph-1') }}</p>
        <p>{{ __('home.first-paragraph-2') }}
          <a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a> {{ __('home.first-paragraph-3') }}
          <a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a> {{ __('home.first-paragraph-4') }}
        </p>
        <h2 class="main-h2">
            <a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a> {{ __('home.bluebar') }}
        </h2>

        <div class="row my-5">
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <img src="/images/what-is-depozyt/1.png" class="img-fluid"/>
            </div>
            <div class="col-12 col-md-6">
                <h2>{{ __('home.first-image-title') }}</h2>
                <p class="text-justify">
                    {{ __('home.first-image-subfirstword') }}<a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a>{{ __('home.first-image-subrest') }}
                </p>
                <p>
                    {{ __('home.first-image-desc') }}
                </p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <h2>{{ __('home.second-image-title') }}</h2>
                <p class="text-justify">
                    {{ __('home.second-image-par1') }}
                </p>
                <p class="text-justify">
                    {{ __('home.second-image-par2-1') }}
                    <a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a>
                    {{ __('home.second-image-par2-2') }}
                </p>
                <p class="text-justify">
                  {{ __('home.second-image-par3') }}
                </p>
                <p class="text-justify">
                    {{ __('home.second-image-par4') }}
                </p>
                <p class="text-justify">
                    {{ __('home.second-image-par5-1') }}
                    <a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a>
                    {{ __('home.second-image-par5-2') }}
                </p>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <img src="/images/what-is-depozyt/2.png" class="img-fluid"/>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <img src="/images/what-is-depozyt/4.png" class="img-fluid"/>
            </div>
            <div class="col-12 col-md-6 ">
                <h2><strong>{{ __('home.third-image-title') }}</strong> <br/>
                  <span>{{ __('home.third-image-subtitle') }}<a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a></span></h2>
                <p class="text-justify"><a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a> {{ __('home.third-image-par1') }}</p>
                <p class="text-justify">
                  {{ __('home.third-image-par2-1') }}
                  <a href='{{ route('home') }}'>{{ __('home.depositlink') }}</a>
                  {{ __('home.third-image-par2-2') }}</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <h2>{{ __('home.fourth-image-title') }}</h2>
                <h3>{{ __('home.fourth-image-subtitle') }}</h3>
                <p class="text-justify">{{ __('home.fourth-image-par1') }}</p>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center">
                <img src="/images/what-is-depozyt/5.png" class="img-fluid"/>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <img src="/images/what-is-depozyt/6.png" class="img-fluid"/>
            </div>
            <div class="col-12 col-md-6
             ">
                <h2>{{ __('home.fifth-image-title') }} <a href='{{ route('home') }}'>depozyt.com</a>
                </h2>
                <p class="text-justify">{{ __('home.fifth-image-par1') }}</p>
                <p class="text-justify">{{ __('home.fifth-image-par2') }}<a href='{{ route('home') }}'>depozyt.com</a></p>
                <p class="text-justify">{{ __('home.fifth-image-par3') }}</p>
            </div>
        </div>
    </div>
@endsection

<style>
    h1 {
        font-size: 1.8rem;
    }

    h2 {
        color: black;
        font-weight: 500;
    }

    h2.main-h2 {
        background: #1b1464;
        text-align: center;
        padding-top: 1.12em;
        padding-bottom: 1.12em;
        color: white;
    }

    h2.main-h2 a {
        color: white;
        text-decoration: none;
        font-weight: 700;
    }
</style>
