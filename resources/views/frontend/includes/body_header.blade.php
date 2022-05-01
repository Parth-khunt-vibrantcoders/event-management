@php

$currentRoute = Route::current()->getName();
if (!empty(Auth()->guard('users')->user())) {
   $data = Auth()->guard('users')->user();
}
@endphp
<style>
.right-side.sign {
    width: 150px !important;
    padding: 0px !important;
    border: none !important;
}
</style><!-- Header Container
        ================================================== -->
        <header id="header-container" class="header head-tr">
            <!-- Header -->
            <div id="header" class="head-tr bottom">
                <div class="container container-header">
                    <!-- Left Side Content -->
                    <div class="left-side">
                        <!-- Logo -->
                        <div id="logo">
                            <a href="{{ route('home') }}">
                                <img src="{{  asset('public/frontend/images/favicon.png') }}" data-sticky-logo="{{  asset('public/frontend/images/favicon.png') }}" alt="">
                            </a>
                        </div>
                        <!-- Mobile Navigation -->
                        <div class="mmenu-trigger">
                            <button class="hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
							<span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                        <!-- Main Navigation -->
                        <nav id="navigation" class="style-1 head-tr">
                            <ul id="responsive">
                                <li class="{{ $currentRoute == 'home' ? 'active' : ''}}"><a href="{{ route('home') }}">Home</a></li>
                                <li class="{{ $currentRoute == 'category' ? 'active' : ''}}"><a href="{{ route('category') }}">Category</a></li>
                                <li class="{{ $currentRoute == 'packages' ? 'active' : ''}}"><a href="{{ route('packages') }}">Packages</a></li>
                                <li class="{{ $currentRoute == 'booking' ? 'active' : ''}}"><a href="{{ route('booking') }}">Booking</a></li>
                                <li class="{{ $currentRoute == 'contact-us' ? 'active' : ''}}"><a href="{{ route('contact-us') }}">Contact</a></li>

                            </ul>
                        </nav>
                        <!-- Main Navigation / End -->
                    </div>
                    <!-- Left Side Content / End -->
                    @if (!empty(Auth()->guard('users')->user()))
                        <!-- Right Side Content / End -->
                        <div class="right-side header-user-menu user-menu add">
                            <div class="header-user-name">
                               Hi, {{ $data['first_name'] }}
                            </div>
                            <ul>

                                <li><a href="{{ route('my-booking') }}"> My Booking</a></li>
                                <li><a href="{{ route('user-logout') }}">Log Out</a></li>
                            </ul>
                        </div>
                    @else
                        <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0" style="margin-right: 0px !important">
                            <div class="header-widget sign-in">
                                <div class="show-reg-form">
                                    <span class="text-white">
                                        <i class="fa fa-sign-in text-white mr-2"></i>
                                        <a href="{{ route('sign-in') }}" class="text-white">Sign In</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif



                    <!-- Right Side Content / End -->

                </div>
            </div>
            <!-- Header / End -->

        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->
