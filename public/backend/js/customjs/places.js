var Places = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#place-list',
            'ajaxURL': baseurl + "admin/places/places-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 3],
            'noSearchApply': [0, 3],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".delete-places", function() {
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
                url: baseurl + "admin/places/places-ajaxcall",
                data: { 'action': 'delete-places', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".deactive-places", function() {
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
                url: baseurl + "admin/places/places-ajaxcall",
                data: { 'action': 'deactive-places', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-places", function() {
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
                url: baseurl + "admin/places/places-ajaxcall",
                data: { 'action': 'active-places', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }
    var add_places = function(){
        var form = $('#place-add');
        var rules = {
            place: { required: true },
        };

        var message = {
            place: {
                required: "Please enter place name"
            },
        }
        handleFormValidateWithMsg(form, rules, message, function(form) {
            handleAjaxFormSubmit(form, true);
        });
    }
    var edit_places = function(){
        var form = $('#place-edit');
        var rules = {
            place: { required: true },
        };

        var message = {
            place: {
                required: "Please enter place name"
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
            add_places();
        },
        edit:function(){
            edit_places();
        },
    }
}();
