@extends('frontend.layouts.layout')
@section('section')

@php
if (!empty(Auth()->guard('users')->user())) {
   $data = Auth()->guard('users')->user();
}
@endphp
<div class="col-lg-12 col-md-12 col-xs-12 pl-0 user-dash2" >

    <div class="dashborad-box" style="padding-top: 150px">
        <h4 class="title">My Booking</h4>
        <div class="section-body listing-table">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Package Name</th>
                            <th>Place</th>
                            <th>Category</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Advance Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @csrf
                        @foreach ($booking_list as $key => $value)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $value['packages'] }}</td>
                            <td>{{ $value['places'] }}</td>
                            <td>{{ $value['event_category'] }}</td>
                            <td>{{ date("d-m-Y", strtotime($value['startdate'])) }}</td>
                            <td>{{ date("d-m-Y", strtotime($value['enddate'])) }}</td>
                            <td>{{ $value['advance_payment'] }}</td>
                            
                            @if ($value['status'] == 'A')
                            <td><span class="mrg-l-5 category-tag" style="background-color: green; color: white;padding:5px;margin:5px">Booked</span></td>
                            @else
                            <td><span class="mrg-l-5 category-tag" style="background-color: red;color: white;padding:5px;margin:5px">Canceled</span></td>
                            @endif
                          
                            @if ($value['status'] == 'A')
                            <td class="edit"><button class="btn btn-danger cancel-booking" data-toggle="modal" data-target="#deleteModel" style="border: #004799 " data-id={{ $value['id'] }}>Cancel</button></td>
                            @else
                            <td class="edit"></td>
                            @endif

                        </tr>
                        @php
                            $i++;
                        @endphp
                        @endforeach

                    </tbody>
                </table>



            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="margin-top: 120px !important ">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cancel Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to cancel booking ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light yes-sure">Yes , I am sure</button>
            </div>
        </div>
    </div>
</div>
@endsection
