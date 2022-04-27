<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}" />
    <meta name="keywords" content="{{ $keywords }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="{{  Config::get('constants.SYSTEM_NAME'); }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="{{  asset('public/backend/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{  asset('public/backend/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{  asset('public/backend/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{  asset('public/backend/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="{{  asset('public/upload/systemsetting/favicon.png') }}" />

    <link href="{{  asset('public/backend/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

    </style>
    @if (!empty($css))
        @foreach ($css as $value)
            @if(!empty($value))
                <link rel="stylesheet" href="{{ asset('public/backend/css/customcss/'.$value) }}">
            @endif
        @endforeach
    @endif


    @if (!empty($plugincss))
        @foreach ($plugincss as $value)
            @if(!empty($value))
                <link rel="stylesheet" href="{{ asset('public/backend/'.$value) }}">
            @endif
        @endforeach
    @endif

    <script>
        var baseurl = "{{ asset('/') }}";
        var date_formate = "dd-M-yyyy";
        var decimal_point = "{{ Config::get('constants.DECIMAL_POINT') }}";
    </script>
</head>
<!--end::Head-->
