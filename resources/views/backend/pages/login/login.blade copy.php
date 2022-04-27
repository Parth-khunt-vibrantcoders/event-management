@extends('backend.layout.login_layout')

@section('section')
@php
if(file_exists( public_path().'/upload/systemsetting/'.get_system_setting_detail()->website_logo) && get_system_setting_detail()->website_logo != null){
    $login_image = url("public/upload/systemsetting/".get_system_setting_detail()->website_logo);
}else{
    $login_image = url("public/upload/systemsetting/default.jpg");
}
@endphp
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
            <!--begin: Aside Container-->
            <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
                <!--begin::Logo-->
                {{-- <a href="#" class="text-center pt-2">
                    <img src="{{  asset('public/upload/system/petroleum.png') }}" class="max-h-150px" alt="" />
                </a> --}}
                <!--end::Logo-->
                <!--begin::Aside body-->
                <div class="d-flex flex-column-fluid flex-column pt-15">
                    <!--begin::Signin-->
                    <div class="login-form login-signin py-11">
                        <!--begin::Form-->
                        <form class="form"  id="login-form" method="POST" enctype="multipart/form-data" action="{{ route('check-login') }}">
                            @csrf
                            <!--begin::Title-->
                            <div class="text-center pb-8">
                                <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Sign In</h2>
                            </div>
                            <!--end::Title-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <label class="font-size-h6 font-weight-bolder text-dark">Email</label>
                                <input class="form-control form-control-solid  py-7 px-6 rounded-lg" type="text" name="email" placeholder="Please enter your register email" autocomplete="off" />
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <div class="d-flex justify-content-between mt-n5">
                                    <label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>
                                </div>
                                <input class="form-control form-control-solid  py-7 px-6 rounded-lg" type="password" name="password" placeholder="Please enter your password"  autocomplete="off" />
                            </div>
                            <!--end::Form group-->
                            <!--begin::Action-->
                            <div class="pt-2">
                                <button type="submit" class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3">Sign In</button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->

                </div>
                <!--end::Aside body-->

            </div>
            <!--end: Aside Container-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0 login-bg text-white" style="background-color: #1f7fb1" >
            <!--begin::Title-->
            <div class="d-flex flex-column justify-content-center text-center pt-15">
                <h3 class="display4 font-weight-bolder my-7 text-white" >{{  Config::get('constants.SYSTEM_NAME'); }}</h3>

            </div>
            <!--end::Title-->
            <!--begin::Image-->
            {{-- <div class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url({{  asset('public/backend/assets/media/svg/illustrations/login-visual-2.svg') }} );"></div> --}}
           <!--begin::Image-->
					<div class="content-img d-flex flex-row-fluid bgi-no-repeat  bgi-position-x-center" style="background-image: url({{  $login_image }} );"></div>
					<!--end::Image-->
            <!--end::Image-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
@endsection
