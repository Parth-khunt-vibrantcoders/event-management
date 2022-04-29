@extends('frontend.layouts.login')
@section('section')
<!-- END SECTION HEADINGS -->
<div class="text-heading text-center" >
    <div class="container" style="margin-top: 150px !important">
        <h2>Sign Up</h2>
    </div>
</div>
  <!-- START SECTION LOGIN -->

  <!-- START SECTION LOGIN -->
<div id="login">
    <div class="login">
        <form id="signup" enctype="multipart/form-data" method="POST" action="{{ route('save-sign-up') }}">@csrf


            <div class="form-group">
                <label>First Name</label>
                <input type="firstname" class="form-control" name="firstname" placeholder="First Name" id="firstname">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="lastname" class="form-control" name="lastname" placeholder="Last Name" id="lastname">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" id="email">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" id="password" value="">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" id="confirm_password" value="">
                <i class="icon_lock_alt"></i>
            </div>

            <button type="submit" class="btn_1 rounded full-width">Sign-in</button>
            <div class="text-center add_top_10">New User? <strong><a href="{{ route('sign-in') }}">Sign In!</a></strong></div>
        </form>
    </div>
</div>
<!-- END SECTION LOGIN -->
@endsection
