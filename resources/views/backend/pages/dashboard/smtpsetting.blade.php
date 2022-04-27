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
                    <form class="form" id="smtp-setting" method="POST" action="{{route('save-smtp-setting')}}">@csrf
                        <div class="card-body">

                            <div class="form-group">
                                <label>Server (Host)
                                <span class="text-danger">*</span></label>
                                <input type="text" name="server" class="form-control" placeholder="Enter server name" value="{{ $smtp_setting[0]['server']}}">

                                <input type="hidden" name="editid" class="form-control" value="{{ $smtp_setting[0]['id']}}">
                            </div>

                            <div class="form-group">
                                <label>User Name
                                <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" placeholder="Enter user name" value="{{ $smtp_setting[0]['username']}}">
                            </div>

                            <div class="form-group">
                                <label>Password
                                <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" value="{{ $smtp_setting[0]['password']}}">
                            </div>

                            <div class="form-group">
                                <label>Port
                                <span class="text-danger">*</span></label>
                                <input type="text" name="port" class="form-control onlyNumber" placeholder="Enter port number" value="{{ $smtp_setting[0]['port']}}">
                            </div>

                            <div class="form-group">
                                <label>Driver
                                <span class="text-danger">*</span></label>
                                <input type="text" name="driver" class="form-control" placeholder="Enter driver" value="{{ $smtp_setting[0]['driver']}}">
                            </div>

                            <div class="form-group">
                                <label>Encryption</label>
                                <select class="form-control select2" id="kt_select2_encryption"  name="encryption">
                                    <option value="">No Encryption</option>
                                    <option value="SSL"  {{ $smtp_setting[0]['encryption'] == 'SSL' ? 'selected="selected"' : ''}}>Use SSL</option>
                                    <option value="TLS" {{ $smtp_setting[0]['encryption'] == 'TLS' ? 'selected="selected"' : ''}} >Use TLS</option>
                                </select>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2 submitbtn">Submit</button>
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
</div>
<!--end::Entry-->



@endsection
