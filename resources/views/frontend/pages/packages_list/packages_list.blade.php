@extends('frontend.layouts.layout')
@section('section')
<style>
    .banner-search-wrap .rld-main-search .single-select {
    width: 100%;
}
</style>
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

                                <div class="listing-badges">

                                    <span class="rent">{{ $value['event_category']}}</span>
                                </div>

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

        </div>
    </section>
    <!-- END SECTION PROPERTIES FOR RENT -->
@endsection
