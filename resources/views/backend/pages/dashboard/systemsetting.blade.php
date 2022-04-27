@extends('backend.layout.layout')
@section('section')
@php
    if(file_exists( public_path().'/upload/systemsetting/'.$system_details[0]['website_logo']) && $system_details[0]['website_logo'] != ''){
        $logoimage = url("public/upload/systemsetting/".$system_details[0]['website_logo']);
    }else{
        $logoimage = url("public/upload/systemsetting/default.jpg");
    }
@endphp
@php
    if(file_exists( public_path().'/upload/systemsetting/'.$system_details[0]['favicon_icon']) && $system_details[0]['favicon_icon'] != ''){
        $faviconimage = url("public/upload/systemsetting/".$system_details[0]['favicon_icon']);
    }else{
        $faviconimage = url("public/upload/systemsetting/default.jpg");
    }
@endphp
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
   <!--begin::Container-->
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
               <form class="form" id="update-system-setting" method="POST" action="{{ route('save-system-setting') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>System Name
                                <span class="text-danger">*</span></label>
                                <input type="text" name="system_name" class="form-control" placeholder="Please enter system name" value="{{(!empty($system_details)) ? $system_details[0]['system_name'] : ''}}">
                                <input type="hidden" name="editid" class="form-control" value="{{(!empty($system_details)) ? $system_details[0]['id'] : ''}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Website Keywords
                                <span class="text-danger">*</span></label>
                                <input id="kt_tagify_1" name="website_keywords" class="form-control tagify" name='tags' placeholder="Enter website keywords" value="{{(!empty($system_details)) ? $system_details[0]['website_keywords'] : ''}}"/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Author Name
                                <span class="text-danger">*</span></label>
                                <input type="text" name="author" class="form-control" placeholder="Please enter author name" value="{{(!empty($system_details)) ? $system_details[0]['author_name'] : ''}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date Formate <span class="text-danger">*</span></label>
                                    <select class="form-control select2" id="date_formate"  name="date_formate">
                                        <option value="">Select Date Formate</option>
                                        @foreach(Config::get('constants.DATE_FORMATE') as $key => $value)
                                            <option value="{{ $key }}" {{ $system_details[0]['date_formate'] == $key ? 'selected="selected"' : ''}}>{{$value}}</option>
                                        @endforeach
                                    </select>


                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Decimal Point
                                <span class="text-danger">*</span></label>
                                <input type="text" name="decimal_point" class="form-control onlyNumber" placeholder="Please enter decimal point" value="{{$system_details[0]['decimal_point']}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Footer Text
                                <span class="text-danger">*</span></label>
                                <input type="text" name="footer_text" class="form-control" placeholder="Please enter webite footer text" value="{{(!empty($system_details)) ? $system_details[0]['footer_text'] : ''}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Footer Link
                                <span class="text-danger">*</span></label>
                                <input type="text" name="footer_link" class="form-control" placeholder="Please enter footer link" value="{{(!empty($system_details)) ?$system_details[0]['footer_link'] : ''}}" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Website Description<span class="text-danger">*</span></label>
                                <textarea name="website_description" class="form-control" placeholder="Please enter website description">{{ (!empty($system_details)) ? $system_details[0]['website_description'] : ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Login Image</label>
                                <div class="">
                                    <div class="image-input image-input-outline" id="kt_image_2">
                                        <div class="image-input-wrapper" style="background-size: 300px 170px;width: 300px;height: 170px;background-image: url({{(!empty($system_details)) ? $logoimage : ''}})"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Login Image">
                                            <i class="fa fa-pencil icon-sm text-muted"></i>
                                            <input type="file" name="website_logo" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="website_logo_remove"/>
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Login Image">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Business Favicon Icon</label>
                                <div class="">
                                    <div class="image-input image-input-outline" id="kt_image_3">
                                        <div class="image-input-wrapper" style="background-image: url({{(!empty($system_details)) ? $faviconimage : ''}})"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pencil icon-sm text-muted"></i>
                                            <input type="file" name="favicon_icon" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="website_favicon_remove"/>
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                  </div>
                  <div class="card-footer">
                     <button type="submit" class="btn btn-primary mr-2 green-btn submitbtn">Submit</button>
                     <button type="reset" class="btn btn-secondary">Cancel</button>
                  </div>
               </form>
               <!--end::Form-->
            </div>
            <!--end::Card-->
         </div>
      </div>
   </div>
   <!--end::Container-->
   <!--end::Container-->
</div>
<!--end::Entry-->
@endsection
