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
                                    <img class="d-block img-fluid" src="{{  asset('public/upload/packages_image/'.$packages_list_details[0]['photo']) }}" alt="First slide">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <br><br>



                <div class="single homes-content details mb-30">
                    <h5 class="mb-4">Package Name : {{ $packages_list_details[0]['name'] }}</h5>
                    <h5 class="mb-4">Package Price : {{ $packages_list_details[0]['price'] }}</h5>
                    <h5 class="mb-4">Event Place : {{ $packages_list_details[0]['places'] }}</h5>
                    <h5 class="mb-4">Event Category : {{ $packages_list_details[0]['event_category'] }}</h5>
                    <h5 class="mb-4">Event Details : {{ $packages_list_details[0]['details'] }}</h5>

                    <a href="{{ route('booking', ['package-id'=> $packages_list_details[0]['id'] ]) }}" class="btn btn-primary btn-anis ml-0">Book Package</a>
                </div>


            </div>

        </div>

    </div>
</section>
<!-- END SECTION PROPERTIES LISTING -->
@endsection
