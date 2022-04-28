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
                    <form class="form" id="place-edit" method="POST" action="{{ route('save-places-edit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Places<span class="text-danger">*</span></label>
                                        <input type="text" name="place" class="form-control" placeholder="Please enter places name" value="{{$places_details[0]['name']}}">
                                        <input type="hidden" name="editId" class="form-control" placeholder="Please enter places name" value="{{$places_details[0]['id']}}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status
                                        <span class="text-danger">*</span></label>
                                        <div class="radio-inline" style="margin-top:10px">
                                            <label class="radio radio-lg radio-success" >
                                            <input type="radio" name="status" class="radio-btn" value="A" {{ $places_details[0]['status'] == 'A' ? 'checked="checked"' : ''}} />
                                            <span></span>Active</label>
                                            <label class="radio radio-lg radio-danger" >
                                            <input type="radio" name="status" class="radio-btn" value="I" {{ $places_details[0]['status'] == 'I' ? 'checked="checked"' : ''}} />
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
