var Packages = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#packages-list',
            'ajaxURL': baseurl + "admin/packages/packages-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 1, 8],
            'noSearchApply': [0, 1, 8],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);


        $("body").on("click", ".delete-packages", function() {
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
                url: baseurl + "admin/packages/packages-ajaxcall",
                data: { 'action': 'delete-packages', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".deactive-packages", function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure-deactive:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure-deactive', function() {
            var id = $(this).attr('data-id');
            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/packages/packages-ajaxcall",
                data: { 'action': 'deactive-packages', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-packages", function() {
            var id = $(this).data('id');

            setTimeout(function() {
                $('.yes-sure-active:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure-active', function() {
            var id = $(this).attr('data-id');

            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/packages/packages-ajaxcall",
                data: { 'action': 'active-packages', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

    }
    var add_package = function(){
        $('.select2').select2();
        var form = $('#packages-add');
        var rules = {
            event_category: { required: true },
            place: { required: true },
            name: { required: true },
            image: { required: true },
            price: { required: true },
            status: { required: true },
        };

        var message = {
            event_category: {
                required: "Please select event category"
            },
            place: {
                required: "Please select place"
            },
            name: {
                required: "Please enter name"
            },
            image: {
                required: "Please select image"
            },
            price: {
                required: "Please enter price"
            },
            status: {
                required: "Please select status"
            },
        }
        handleFormValidateWithMsg(form, rules, message, function(form) {
            handleAjaxFormSubmit(form, true);
        });
        //
    }
    var edit_package = function(){
        $('.select2').select2();
        var form = $('#packages-edit');
        var rules = {
            event_category: { required: true },
            place: { required: true },
            name: { required: true },
            price: { required: true },
            status: { required: true },
        };

        var message = {
            event_category: {
                required: "Please select event category"
            },
            place: {
                required: "Please select place"
            },
            name: {
                required: "Please enter name"
            },
            price: {
                required: "Please enter price"
            },
            status: {
                required: "Please select status"
            },
        }
        handleFormValidateWithMsg(form, rules, message, function(form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    return {
        init:function(){
            list();
        },
        add:function(){
            add_package();
        },
        edit:function(){
            edit_package();
        }
    }
}();
