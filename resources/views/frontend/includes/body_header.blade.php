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
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('category') }}">Category</a></li>
                                <li><a href="{{ route('packages') }}">Packages</a></li>
                                <li><a href="{{ route('contact-us') }}">Contact</a></li>

                            </ul>
                        </nav>
                        <!-- Main Navigation / End -->
                    </div>
                    <!-- Left Side Content / End -->

                    <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                        <!-- Header Widget -->
                        <div class="header-widget sign-in">
                            @if (!empty(Auth()->guard('users')->user()))
                                <div class="show-reg-form">
                                    <a href="{{ route('my-dashboard') }}">My Dashboard</a>
                                </div>
                            @else
                                <div class="show-reg-form">
                                    <span class="text-white">
                                        <i class="fa fa-sign-in text-white mr-2"></i>
                                        <a href="{{ route('sign-in') }}" class="text-white">Sign In</a>
                                    </span>
                                </div>
                            @endif
                        </div>
                        <!-- Header Widget / End -->
                    </div>
                    <!-- Right Side Content / End -->

                </div>
            </div>
            <!-- Header / End -->

        </header>
        <div class="clearfix"></div>
        <!-- Header Container / End -->
