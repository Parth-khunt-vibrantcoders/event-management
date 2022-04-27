var Subscriber = function(){
    var import_data = function(){
        var form = $('#add-import-subscriber');
        var rules = {
            file: {required: true},
        };
        var message = {
            file : {
                required : "Please select excel sheet"
            }
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var list = function(){

        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'pageLength': 20,
            'tableID': '#subscriber-list',
            'ajaxURL': baseurl + "admin/users/subscriber-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 10],
            'noSearchApply': [0],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".delete-subscriber", function() {
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
                url: baseurl +"admin/users/subscriber-ajaxcall",
                data: { 'action': 'delete-subscriber', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var addSubscriber = function(){
        $('.select2').select2();
        $('#start_date').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "bottom left",
            templates: arrows,
            format: date_formate,
            autoclose: true,
            // endDate: yesterday,
        });

        $('body').on('change', '#start_date', function() {
            var startdate = '';

            startdate = $("#start_date").val();

            if (startdate != '' || startdate != null) {
                startdate = new Date(startdate);
                startdate.setDate(startdate.getDate() + 1);

                var html = ' <label>Subscription End Date</label>' +
                    '<input class="form-control change-calculation" name="end_date" type="text" id="end_date" value="" placeholder="Please enter subscription end date" autocomplete="off"/>';
                $("#end-date-div").html(html);
                $('#end_date').datepicker({
                    rtl: KTUtil.isRTL(),
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: arrows,
                    format: date_formate,
                    autoclose: true,
                    startDate: startdate,
                    // endDate: new Date(),
                });
            } else {
                var html = ' <label>Subscription End Date</label>' +
                    '<input class="form-control change-calculation" name="end_date" type="text" id="end_date" disabled="disabled" value="" placeholder="Please enter subscription end date" autocomplete="off"/>';
                $("#end-date-div").html(html);
            }
        });
        var form = $('#add-import-subscriber');
        var rules = {
            sr_no: {required: true},
            name: {required: true},
            address_1: {required: true},
            email: {email: true},
            price: {required: true},
        };

        var message = {
            sr_no: {required: "Please enter subscriber sr.no"},
            name: {required: "Please enter subscriber name"},
            address_1: {required: "Please enter subscriber address"},
            email :{
                email: "Please enter subscriber valid email address"
            },
            price: {required: "Please enter subscription price"},
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }


    var editSubscriber = function(){
        $('.select2').select2();
        $('#start_date').datepicker({
            rtl: KTUtil.isRTL(),
            orientation: "bottom left",
            templates: arrows,
            format: date_formate,
            autoclose: true,
            // endDate: yesterday,
        });

        $('body').on('change', '#start_date', function() {
            var startdate = '';

            startdate = $("#start_date").val();

            if (startdate != '' || startdate != null) {
                startdate = new Date(startdate);
                startdate.setDate(startdate.getDate() + 1);

                var html = ' <label>Subscription End Date</label>' +
                    '<input class="form-control change-calculation" name="end_date" type="text" id="end_date" value="" placeholder="Please enter subscription end date" autocomplete="off"/>';
                $("#end-date-div").html(html);
                $('#end_date').datepicker({
                    rtl: KTUtil.isRTL(),
                    todayHighlight: true,
                    orientation: "bottom left",
                    templates: arrows,
                    format: date_formate,
                    autoclose: true,
                    startDate: startdate,
                    // endDate: new Date(),
                });
            } else {
                var html = ' <label>Subscription End Date</label>' +
                    '<input class="form-control change-calculation" name="end_date" type="text" id="end_date" disabled="disabled" value="" placeholder="Please enter subscription end date" autocomplete="off"/>';
                $("#end-date-div").html(html);
            }
        });
        var form = $('#edit-import-subscriber');
        var rules = {
            sr_no: {required: true},
            name: {required: true},
            address_1: {required: true},
            email: {email: true},
            price: {required: true},
        };

        var message = {
            sr_no: {required: "Please enter subscriber sr.no"},
            name: {required: "Please enter subscriber name"},
            address_1: {required: "Please enter subscriber address"},
            email :{
                email: "Please enter subscriber valid email address"
            },
            price: {required: "Please enter subscription price"},
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    return {
        importdata:function(){
            import_data();
        },
        init:function(){
            list();
        },
        add:function(){
            addSubscriber();
        },
        edit: function(){
            editSubscriber();
        }
    }
}();
