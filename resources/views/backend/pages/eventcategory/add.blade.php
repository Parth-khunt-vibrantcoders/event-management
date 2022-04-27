@extends('backend.layout.layout')
@section('section')

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
                    <form class="form" id="event-category-add" method="POST" action="{{ route('save-event-category') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Event Category<span class="text-danger">*</span></label>
                                        <input type="text" name="event_category" class="form-control" placeholder="Please enter event category name">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Event Image<span class="text-danger">*</span></label>
                                        <input type="file" name="event_image" class="form-control" placeholder="Please select event category image">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status
                                        <span class="text-danger">*</span></label>
                                        <div class="radio-inline" style="margin-top:10px">
                                            <label class="radio radio-lg radio-success" >
                                            <input type="radio" name="status" class="radio-btn" value="A" checked="checked"/>
                                            <span></span>Active</label>
                                            <label class="radio radio-lg radio-danger" >
                                            <input type="radio" name="status" class="radio-btn" value="I"/>
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
