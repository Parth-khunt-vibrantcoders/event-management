@extends('backend.layout.layout')
@section('section')

<!--begin::Main-->
<div class="d-flex flex-column flex-root m-10">
    <!--begin::Error-->
      <!--begin::Dashboard-->
      <div class="error error-3 d-flex flex-row-fluid bgi-size-cover bgi-position-center" style="background-image: url({{  asset('public/backend/media/error/bg3.jpg') }});">
        <!--begin::Content-->
        <div class="px-10 px-md-30 py-10 py-md-0 d-flex flex-column justify-content-md-center">
            <h1 class="error-title text-stroke text-transparent" style="font-size: 6rem !important">Comming Soon</h1>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Dashboard-->
    <!--end::Error-->
</div>

@endsection
