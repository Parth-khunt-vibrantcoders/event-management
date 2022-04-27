var Eventcategory = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#event-category-list',
            'ajaxURL': baseurl + "admin/event-category/event-category-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 4],
            'noSearchApply': [0, 4],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".delete-event-category", function() {
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
                url: baseurl + "admin/event-category/event-category-ajaxcall",
                data: { 'action': 'delete-event-category', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".deactive-event-category", function() {
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
                url: baseurl + "admin/event-category/event-category-ajaxcall",
                data: { 'action': 'deactive-event-category', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-event-category", function() {
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
                url: baseurl + "admin/event-category/event-category-ajaxcall",
                data: { 'action': 'active-event-category', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var add_eventcategory = function(){
        var form = $('#event-category-add');
        var rules = {
            event_category: { required: true },
            event_image: { required: true },
            status: { required: true },
        };

        var message = {
            event_category: {
                required: "Please enter event category name"
            },
            event_image: {
                required: "Please select event category image"
            },
            status: {
                required: "Please select status"
            },
        }
        handleFormValidateWithMsg(form, rules, message, function(form) {
            handleAjaxFormSubmit(form, true);
        });
    }

    var edit_eventcategory = function(){
        var form = $('#event-category-edit');
        var rules = {
            event_category: { required: true },

            status: { required: true },
        };

        var message = {
            event_category: {
                required: "Please enter event category name"
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
            add_eventcategory();
        },
        edit:function(){
            edit_eventcategory();
        },
    }
}();
