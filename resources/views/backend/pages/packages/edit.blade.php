@extends('backend.layout.layout')
@section('section')
@php
    if(file_exists( public_path().'/upload/packages_image/'.$packages_details[0]['photo']) && $packages_details[0]['photo'] != ''){
        $packages = url("public/upload/packages_image/".$packages_details[0]['photo']);
    }else{
        $packages = url("public/upload/packages_image/no-image.png");
    }
@endphp
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ $header['title'] }}</h3>
                    </div>
                    <!--begin::Form-->
                    <form class="form" id="packages-edit" method="POST" action="{{ route('save-packages-edit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Event Category<span class="text-danger">*</span></label>
                                        <select class="form-control select2" id="event_category"  name="event_category" >
                                            <option value="">Please event category</option>
                                            @foreach ($event_category_list as $key => $value)
                                                <option value="{{ $value['id'] }}" {{ $packages_details[0]['category'] == $value['id'] ? 'selected="selected"' : ''}}>{{ $value['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Places<span class="text-danger">*</span></label>
                                       <select class="form-control select2" id="place"  name="place" >
                                        <option value="">Please select places</option>
                                        @foreach ($place_list as $key => $value)
                                            <option value="{{ $value['id'] }}" {{ $packages_details[0]['places'] == $value['id'] ? 'selected="selected"' : ''}}>{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Packages Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Please enter packages name" value="{{ $packages_details[0]['name'] }}">
                                        <input type="hidden" name="editId" class="form-control" placeholder="Please enter packages name" value="{{ $packages_details[0]['id'] }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Packages Photo<span class="text-danger">*</span></label>
                                        <label class="text-danger" style="float: right !important">
                                            <a class="text-danger" href="{{ $packages }}" target="_blank">View Photo</a></label>
                                        <input type="file" name="packages_image" class="form-control" placeholder="Please enter packages photo" >
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Packages Details</label>
                                        <textarea name="detail" class="form-control" placeholder="Please enter packages details" >{{ $packages_details[0]['details'] }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Packages Price<span class="text-danger">*</span></label>
                                        <input type="text" name="price" class="form-control onlyNumber" placeholder="Please enter packages price" value="{{ $packages_details[0]['price'] }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status
                                        <span class="text-danger">*</span></label>
                                        <div class="radio-inline" style="margin-top:10px">
                                            <label class="radio radio-lg radio-success" >
                                            <input type="radio" name="status" class="radio-btn" value="A" {{ $packages_details[0]['status'] == 'A' ? 'checked="checked"' : ''}} />
                                            <span></span>Active</label>
                                            <label class="radio radio-lg radio-danger" >
                                            <input type="radio" name="status" class="radio-btn" value="I" {{ $packages_details[0]['status'] == 'I' ? 'checked="checked"' : ''}} />
                                            <span></span>Deactive</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2 green-btn submitbtn">Save</button>
                            <a href="{{ route('event-category-list') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->

            </div>

        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->
@endsection
