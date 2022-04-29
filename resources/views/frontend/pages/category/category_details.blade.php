@extends('frontend.layouts.layout')
@section('section')

 <!-- START SECTION PROPERTIES LISTING -->
 <section class="single-proper blog details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 blog-pots">
                <div class="row">
                    <div class="col-md-12">
                        <br><br>

                        <!-- main slider carousel items -->
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            </ol>
                            <div class="carousel-inner carus" role="listbox">
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid" src="{{  asset('public/frontend/images/slider/home-slider-1.jpg') }}" alt="First slide">
                                </div>

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <br><br>
                        <div class="pro-wrapper">
                            <div class="detail-wrapper-body">
                                <div class="listing-title-bar">
                                    <h3>{{ $event_category_details[0]['name'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>
<!-- END SECTION PROPERTIES LISTING -->

@endsection
