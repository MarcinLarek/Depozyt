@extends('frontend.layout.master')

@section('content')
    <div class="row">
        <h2 class="mx-auto main-color mt-2 font-weight-bold" style="color:#081e75">{{ __('home.index-title') }}</h2>
    </div>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
  <div class="carousel-inner">
    <div class="carousel-item active h-100" data-interval="false">
        <img id="cover-image" src="{{ asset('/images/home-banners/1.jpg') }}" style="height: 400px; width: 100%; filter: brightness(43%);">
        <div class="carousel-caption h-100 w-75">
            <h1 style="font-size:70px; padding-top:100px;">{{ __('home.banner1') }}</h1>
            <a href="{{ route('what-is-depozyt') }}" id="read-more"><button type="button" class="btn btn-outline-light" style="font-size:40px; margin-top:30px;border-radius: 50px;border-width:2px;">{{ __('home.readmore') }}</button></a>
        </div>
    </div>

    <div class="carousel-item h-100" data-interval="false">
      <img id="cover-image" src="{{ asset('/images/home-banners/4.jpg') }}" style="height: 400px; width: 100%; filter: brightness(43%);">
      <div class="carousel-caption h-100 w-75">
        <h1 style="font-size:70px; padding-top:100px;">{{ __('home.banner2') }}</h1>
        <a href="{{ route('what-is-depozyt') }}" id="read-more"><button type="button" class="btn btn-outline-light" style="font-size:40px; margin-top:30px;border-radius: 50px;border-width:2px;">{{ __('home.readmore') }}</button></a>
    </div>
    </div>

    <div class="carousel-item h-100" data-interval="false">
      <img id="cover-image" src="{{ asset('/images/home-banners/3.jpg') }}" style="height: 400px; width: 100%; filter: brightness(43%);">
      <div class="carousel-caption">
        <h1 style="font-size:70px; padding-top:100px;">{{ __('home.banner3') }}</h1>
        <a href="{{ route('what-is-depozyt') }}" id="read-more"><button type="button" class="btn btn-outline-light" style="font-size:40px; margin-top:30px;border-radius: 50px;border-width:2px;">{{ __('home.readmore') }}</button></a>
      </div>
    </div>

    <div class="carousel-item h-100" data-interval="false">
      <img id="cover-image" src="{{ asset('/images/home-banners/2.jpg') }}" style="height: 400px; width: 100%; filter: brightness(43%);">
      <div class="carousel-caption h-100">
        <h1 style="font-size:70px; padding-top:100px;">{{ __('home.banner4') }}</h1>
        <a href="{{ route('what-is-depozyt') }}" id="read-more"><button type="button" class="btn btn-outline-light" style="font-size:40px; margin-top:30px;border-radius: 50px;border-width:2px;">{{ __('home.readmore') }}</button></a>
      </div>

    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
   <span class="sr-only">Previous</span>
 </a>
 <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
   <span class="carousel-control-next-icon" aria-hidden="true"></span>
   <span class="sr-only">Next</span>
 </a>
  </div>
</div>


    <article class="backgroud-europe" style="background-image:url({{url('/images/background-europe2.jpg')}}); background-size: cover; backgroud-opacity: 0.5;">

    <div class="content">
        <p class="col-md-8 mx-auto text-center" style="font-size: 25px;color:#081e75; padding-top:50px;">
            {{ __('home.subtitle') }}
        </p>
        <div class="row">
            <h2 class="mx-auto font-weight-bold" style="color:#081e75">{{ __('home.icons-title') }}?</h2>
        </div>
        <div class="col-md-10 mx-auto">
            <div class="row mt-4 text">
                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <div style="height: 150px;" class="my-auto">
                            <img class="mx-auto d-block" src="{{ asset('/images/wektor 1.png') }}" />
                        </div>
                        <h3 class="mt-md-2 text-center font-weight-bold text_color">{{ __('home.first-icon') }}</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <div style="height: 150px;" class="my-auto">
                            <img class="mx-auto d-block" src="{{ asset('/images/wektor 2.png') }}" />
                        </div>
                        <h3 class="mt-md-2 text-center font-weight-bold text_color">{{ __('home.second-icon') }}</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <div style="height: 150px;" class="my-auto">
                            <img class="mx-auto d-block" src="{{ asset('/images/wektor 3.png') }}" />
                        </div>
                        <h3 class="mt-md-2 text-center font-weight-bold text_color">{{ __('home.third-icon') }}</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <div style="height: 150px;" class="my-auto">
                            <img class="mx-auto d-block" src="{{ asset('/images/wektor 4.png') }}"  alt="Zrealizuj usługę"/>
                        </div>
                        <h3 class="mt-md-2 text-center font-weight-bold text_color">{{ __('home.fourth-icon') }}</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <div style="height: 150px;" class="my-auto">
                            <img class="mx-auto d-block" src="{{ asset('/images/wektor 5.png') }}" />
                        </div>
                        <h3 class="mt-md-2 text-center font-weight-bold text_color">{{ __('home.fifth-icon') }}</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-2">
                    <div class="info-box">
                        <div style="height: 150px;" class="my-auto">
                            <img class="mx-auto d-block" ssrc="{{ asset('/images/wektor 6.png') }}" />
                        </div>
                        <h3 class="mt-md-2 text-center font-weight-bold text_color">{{ __('home.sixth-icon') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row my-4">

            <a href="{{ route('how-it-works') }}" class="mx-auto"><button type="button" class="btn btn-outline-primary" style="font-size:40px; margin-top:30px;margin-bottom:30px;border-radius: 50px;border-width:2px; ">{{ __('home.learnmore') }}</button></a>

        </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="col-md-11 mx-auto">
                    <img src="/images/home-depozyt/1.png" class="img-fluid" />
                </div>
                <div class="mt-4">
                    <h3 class="main-color font-weight-bold text-center" style="color:#081e75">{{ __('home.first-image-title') }}</h3>
                    <p class="text-justify">
                        {{ __('home.first-image-desc') }}
                    </p>
                </div>
                <div class="row text-center">
                    <a class="font-weight-bold mx-auto" href="{{ route('what-is-depozyt') }}" style="color:#081e75;font-size:35px">{{ __('home.more') }}</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-11 mx-auto">
                    <img src="/images/home-depozyt/2.png" class="img-fluid" />
                </div>
                <h3 class="main-color font-weight-bold text-center" style="color:#081e75">
                    {{ __('home.second-image-title') }}
                </h3>
                <p class="text-justify">
                    {{ __('home.second-image-desc') }}
                </p>
                <div class="row text-center">
                    <a class="main-color font-weight-bold mx-auto" href="{{ route('what-is-depozyt') }}" style="color:#081e75;font-size:35px">{{ __('home.more') }}</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-11 mx-auto">
                    <img src="/images/home-depozyt/3.png" class="img-fluid" />
                </div>
                <h3 class="main-color font-weight-bold text-center" style="color:#081e75">
                    {{ __('home.third-image-title') }}
                </h3>
                <p class="text-justify">
                    {{ __('home.third-image-desc') }}
                </p>
                <div class="row text-center">
                    <a class="font-weight-bold mx-auto" href="{{ route('what-is-depozyt') }}" style="color:#081e75;font-size:35px">{{ __('home.more') }}</a>
                </div>
            </div>
        </div>

        <div class="row" style="color:#081e75">
            <h2 class="mx-auto main-color mt-5 mb-4 font-weight-bold">{{ __('home.bottom-title') }}</h2>
        </div>
        <div class="col-md-10 mx-auto profits">
            <div class="row text-center">
                <div class="col-md-2 image-space mx-0 px-0 ml-auto">
                    <img src="/images/profits/1.png" />
                    <p>{{ __('home.bottom-desc1') }}</p>
                </div>
                <div class="col-md-3 image-space mx-0 px-0">
                    <img src="/images/profits/2.png" />
                    <p>{{ __('home.bottom-desc2') }}  </p>
                </div>
                <div class="col-md-2 image-space mx-0 px-0">
                    <img src="/images/profits/3.png" />
                    <p>{{ __('home.bottom-desc3') }}</p>
                </div>
                <div class="col-md-3 image-space mx-0 px-0">
                    <img src="/images/profits/4.png" />
                    <p>{{ __('home.bottom-desc4') }}</p>
                </div>
                <div class="col-md-2 image-space mx-0 px-0 mr-auto">
                    <img src="/images/profits/5.png" />
                    <p>{{ __('home.bottom-desc5') }}</p>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection
