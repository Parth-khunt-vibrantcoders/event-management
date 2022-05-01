@extends('frontend.layouts.layout')
@section('section')
<!-- START SECTION CONTACT US -->
<section class="contact-us">
    <div class="container" >

        <div class="row" >
            <div class="col-lg-12 col-md-12" style="margin-top: 220px !important">
                <h3 class="mb-4">Contact Us</h3>
                <form id="contact-form" class="contact-form" name="contact-form" method="post" action="{{ route('save-contact-form') }}" >@csrf
                    <div id="success" class="successform">
                        <p class="alert alert-success font-weight-bold" role="alert">Your message was sent successfully!</p>
                    </div>
                    <div id="error" class="errorform">
                        <p>Something went wrong, try refreshing and submitting the form again.</p>
                    </div>
                    <div class="form-group">
                        <input type="text"  class="form-control input-custom input-full" name="name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text"  class="form-control input-custom input-full" name="lastname" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control input-custom input-full" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control textarea-custom input-full" id="ccomment" name="message"  rows="8" placeholder="Message"></textarea>
                    </div>
                    <button type="submit" id="submit-contact" class="btn btn-primary btn-lg">Submit</button>
                </form>
            </div>
        </div>
        <br><br>
    </div>
</section>
<!-- END SECTION CONTACT US -->
@endsection
