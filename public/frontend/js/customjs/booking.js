var Booking = function(){
    var addBooking = function(){
        var form = $('#book-package');
        var rules = {
            package: {required: true},
            place: {required: true},
            category: {required: true},
            price: {required: true},
            startdate: {required: true},
            enddate: {required: true}
        };

        var message = {

            package : {
                required : "Please select package"
            },
            place : {
                required : "Please enter place"
            },
            category : {
                required : "Please enter category"
            },
            price : {
                required : "Please enter price"
            },
            startdate : {
                required : "Please select start date"
            },
            enddate : {
                required : "Please select end date"
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });

        $('body').on('change', '#startdate', function(){
            var value =  $(this).val();
            $("#enddate").val();
            $("#enddate").prop('min', value);
        });
        $('body').on('change', '#package', function(){
            var value =  $(this).val();
            var data = {_token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "users/booking-ajaxcall",
                data: { 'action': 'change-package', 'value': value },
                success: function(data) {
                    $("#loader").show();
                    var output = JSON.parse(data);
                    var place =$("#place").val(output[0]['places']);
                    var category =$("#category").val(output[0]['event_category']);
                    var price =$("#price").val(output[0]['price']);
                }
            });
        });
    }

    var booking_list = function(){

        $("body").on("click", ".cancel-booking", function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "users/booking-ajaxcall",
                data: { 'action': 'cancel-booking', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }
    return {
        init:function(){
            addBooking();
        },
        list:function(){
            booking_list();
        }
    }
}();
