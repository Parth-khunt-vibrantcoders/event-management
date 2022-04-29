@php
$currentRoute = Route::current()->getName();
@endphp
<div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
    <div class="user-profile-box mb-0">

        <div class="detail clearfix">
            <ul class="mb-0">
                <li>
                    <a  href="{{ route('home') }}">
                        <i class="fa fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <a class="{{ $currentRoute == 'my-dashboard' ? 'active' : ''}}" href="{{ route('my-dashboard') }}">
                        <i class="fa fa-map-marker"></i> My Dashboard
                    </a>
                </li>

                <li>
                    <a class="{{ $currentRoute == 'my-booking' || $currentRoute == 'view-booking' ? 'active' : ''}}" href="{{ route('my-booking') }}">
                        <i class="fa fa-calendar"></i> My Booking
                    </a>
                </li>

                <li>
                    <a href="{{ route('user-logout')}}">
                        <i class="fas fa-sign-out-alt"></i>Log Out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
