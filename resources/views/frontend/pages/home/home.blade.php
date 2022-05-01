@extends('frontend.layouts.layout')
@section('section')
<style>
    .banner-search-wrap .rld-main-search .single-select {
    width: 100%;
}
</style>
        <!-- STAR HEADER SEARCH -->
        <section id="hero-area" class="parallax-searchs home15 overlay thome-6 thome-1" data-stellar-background-ratio="0.5">
            <div class="hero-main">
                <div class="container" data-aos="zoom-in">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-inner">
                                <!-- Welcome Text -->
                                <div class="welcome-text">
                                    <h1 class="h1">Make Your Events Standout with Us
                                    <br class="d-md-none">
                                    <span class="typed border-bottom"></span>
                                </h1>

                                </div>
                                <!--/ End Welcome Text -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END HEADER SEARCH -->

        <!-- START SECTION PROPERTIES FOR SALE -->
        <section class="featured portfolio bg-white-3">
            <div class="container">
                <div class="row">
                    <div class="section-title col-md-5">

                        <h2>Event Category</h2>
                    </div>
                </div>
                <div class="row portfolio-items">
                    @foreach ($event_category_list as $key => $value)
                        <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                            <div class="project-single" data-aos="zoom-in">
                                <div class="listing-item compact">
                                    <a href="{{ route('category-details', $value['id']) }}" class="listing-img-container">

                                        <div class="listing-img-content">
                                            <span class="listing-compact-title">{{ $value['name']}}</span>

                                        </div>
                                        <img src="{{  asset('public/upload/event_image/'.$value['image']) }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="bg-all">
                    <a href="{{ route('category') }}" class="btn btn-outline-light">View All</a>
                </div>
            </div>
        </section>
        <!-- END SECTION PROPERTIES FOR SALE -->

        <!-- START SECTION WHY CHOOSE US -->
        <section class="how-it-works bg-white-2">
            <div class="container">
               <div class="row">
                    <div class="section-title col-md-5">
                        <h3>Why</h3>
                        <h2>Choose Us</h2>
                    </div>
                </div>
                <div class="row service-1">
                    <article class="col-lg-4 col-md-6 col-xs-12 serv" data-aos="fade-up">
                        <div class="serv-flex">
                            <div class="art-1 img-13">
                                <img src="{{  asset('public/frontend/images/icons/icon-4.svg') }}" alt="">
                                <h3>lorem ipsum dolor sit amet</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">lorem ipsum dolor sit amet, consectetur pro adipisici consectetur debits adipisicing lacus consectetur Business Directory.</p>
                            </div>
                        </div>
                    </article>
                    <article class="col-lg-4 col-md-6 col-xs-12 serv" data-aos="fade-up">
                        <div class="serv-flex">
                            <div class="art-1 img-14">
                                <img src="{{  asset('public/frontend/images/icons/icon-5.svg') }}" alt="">
                                <h3>lorem ipsum dolor sit amet</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">lorem ipsum dolor sit amet, consectetur pro adipisici consectetur debits adipisicing lacus consectetur Business Directory.</p>
                            </div>
                        </div>
                    </article>
                    <article class="col-lg-4 col-md-6 col-xs-12 serv mb-0 pt" data-aos="fade-up">
                        <div class="serv-flex arrow">
                            <div class="art-1 img-15">
                                <img src="{{  asset('public/frontend/images/icons/icon-6.svg') }}" alt="">
                                <h3>lorem ipsum dolor sit amet</h3>
                            </div>
                            <div class="service-text-p">
                                <p class="text-center">lorem ipsum dolor sit amet, consectetur pro adipisici consectetur debits adipisicing lacus consectetur Business Directory.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <!-- END SECTION WHY CHOOSE US -->

        <!-- START SECTION PROPERTIES FOR RENT -->
        <section class="featured portfolio bg-white-3">
            <div class="container">
                <div class="row">
                    <div class="section-title col-md-5">
                        <h2>Packages</h2>
                    </div>
                </div>
                <div class="row portfolio-items">

                    @foreach ($packages_list as $key => $value)
                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="zoom-in">
                            <div class="listing-item compact">
                                <a href="{{  route('packages-details', $value['id'])}}" class="listing-img-container">

                                    <div class="listing-img-content">
                                        <span class="listing-compact-title">{{ $value['name']}}</span>

                                    </div>
                                    @php
                                        if(file_exists( public_path().'/upload/packages_image/'.$value['photo']) && $value['photo'] != ''){
                                            $packages = url("public/upload/packages_image/".$value['photo']);
                                        }else{
                                            $packages = url("public/upload/packages_image/no-image.png");
                                        }
                                    @endphp
                                    <img src="{{  $packages }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="bg-all">
                    <a href="{{  route('packages') }}" class="btn btn-outline-light">View All</a>
                </div>
            </div>
        </section>
        <!-- END SECTION PROPERTIES FOR RENT -->



        <!-- STAR SECTION PARTNERS -->
        <div class="partners bg-white-3">
            <div class="container">
                <div class="sec-title">
                    <h2><span>Our </span>Partners</h2>
                    <p>The Companies That Represent Us.</p>
                </div>
                <div class="owl-carousel style2">
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/11.jpg') }}" alt=""></div>
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/12.jpg') }}" alt=""></div>
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/13.jpg') }}" alt=""></div>
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/14.jpg') }}" alt=""></div>
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/15.jpg') }}" alt=""></div>
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/16.jpg') }}" alt=""></div>
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/17.jpg') }}" alt=""></div>
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/11.jpg') }}" alt=""></div>
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/12.jpg') }}" alt=""></div>
                    <div class="owl-item" data-aos="fade-up"><img src="{{  asset('public/frontend/images/partners/13.jpg') }}" alt=""></div>
                </div>
            </div>
        </div>
        <!-- END SECTION PARTNERS -->

@endsection
