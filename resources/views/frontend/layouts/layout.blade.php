<!DOCTYPE html>
<html lang="zxx">
@include('frontend.includes.header')

<body class="homepage-6 homepage-9 homepage-4 hp-6">
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- START SECTION HEADINGS -->
        @include('frontend.includes.body_header')
        @yield('section')
        @include('frontend.includes.body_footer')

        @include('frontend.includes.model')

        <!-- START PRELOADER -->
        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>
        <!-- END PRELOADER -->
        @include('frontend.includes.footer')
    </div>
    <!-- Wrapper / End -->
</body>
</html>
