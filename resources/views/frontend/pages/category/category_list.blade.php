@extends('frontend.layouts.layout')
@section('section')
 <!-- START SECTION PROPERTIES LISTING -->
 <section class="properties-right featured portfolio blog pt-5" style="background: none !important">
    <div class="container">
        <br><br><br><br>
        <div class="row">
            <div class="col-lg-12 col-md-12 blog-pots">

                <div class="row">
                    @foreach($event_category_list as $key => $value)
                        <div class="item col-lg-4 col-md-4 col-xs-12 landscapes sale">
                            <div class="project-single" data-aos="fade-up">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="{{ route('category-details', $value['id']  )}}" class="homes-img">

                                            <img src="{{  asset('public/upload/event_image/'.$value['image']) }}" alt="home-1" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="button-effect">
                                        <a href="{{ route('category-details', $value['id']  )}}" class="btn"><i class="fa fa-link"></i></a>

                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <h3><a href="{{ route('category-details', $value['id']  )}}">{{$value['name']}}</a></h3>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>
</section>
<!-- END SECTION PROPERTIES LISTING -->
@endsection
