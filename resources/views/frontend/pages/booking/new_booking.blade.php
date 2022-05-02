@extends('frontend.layouts.layout')
@section('section')
<style>
    #login .login, #register .login {
        width: 750px !important;
    }
</style>
<!-- END SECTION HEADINGS -->
<div class="text-heading text-center" >
    <div class="container" style="margin-top: 200px !important">
        <h2>Book Package</h2>
    </div>
</div>
  <!-- START SECTION LOGIN -->
  <div id="login">
    <div class="login" style="margin-bottom: 30px !important">
        <form id="book-package" enctype="multipart/form-data" method="POST" action="{{ route('save-book-package') }}">@csrf

            <div class="form-group">
                <label>Package Name</label>
                <select class="form-control" name="package" placeholder="Package" id="package" >
                    <option value="" selected="selected">Select Package</option>
                    @foreach ($packages_list as $key => $value)
                        <option {{ $packages_list_details[0]['id'] == $value['id'] ? 'selected="selected"' : ''}} value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Place</label>
                <input type="text" class="form-control" name="place" placeholder="Place" id="place" readonly value="{{ $packages_list_details[0]['places'] }}">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" class="form-control" name="category" placeholder="Category" id="category" readonly value="{{ $packages_list_details[0]['event_category'] }}">
                <i class="icon_lock_alt"></i>
            </div>

            <div class="form-group">
                <label>Price</label>
                <input type="text" class="form-control" name="price" placeholder="Price" id="price" readonly value="{{ $packages_list_details[0]['price'] }}">
                <i class="icon_lock_alt"></i>
            </div>

            <div class="form-group">
                <label>Start Date</label>
                <input type="date" class="form-control" name="startdate" placeholder="Start Date" min="{{ date('Y-m-d')}}" id="startdate">
                <i class="icon_lock_alt"></i>
            </div>

            <div class="form-group">
                <label>End Date</label>
                <input type="date" class="form-control" name="enddate" placeholder="End Date" min="{{ date('Y-m-d')}}" id="enddate">
                <i class="icon_lock_alt"></i>
            </div>
            
            <div class="form-group">
                <label>Advance Payment</label>
                <input type="number" class="form-control" name="advance_payment" placeholder="Advance Payment"  id="advance_payment">
                <i class="icon_lock_alt"></i>
            </div>

            <button type="submit" class="btn_1 rounded full-width" >Book Package</button>

        </form>
    </div>
</div>
<!-- END SECTION LOGIN -->
@endsection
