<!DOCTYPE html>
<html lang="zxx">

@include('frontend.includes.header')

<body class="inner-pages hd-white">
<style>
    #login .login, #register .login {
        width: 750px !important;
    }
</style>
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- START SECTION HEADINGS -->
       @include('frontend.includes.body_header')

        @yield('section')
        @include('frontend.includes.body_footer')

        <!-- ARCHIVES JS -->
        @include('frontend.includes.footer')
    </div>
    <!-- Wrapper / End -->
</body>
</html>
