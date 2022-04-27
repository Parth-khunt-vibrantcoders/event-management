var Smtpsetting = function() {
    var smtp = function() {
        $('.select2').select2();

        var form = $('#smtp-setting');
        var rules = {

            server: { required: true },
            username: { required: true },
            password: { required: true },
            port: { required: true },
            driver: { required: true },
            // encryption: {required: true},
        };

        var message = {

            server: {
                required: "Please enter server id"
            },
            username: {
                required: "Please enter username"
            },
            password: {
                required: "Please enter password"
            },
            port: {
                required: "Please enter port number"
            },
            driver: {
                required: "Please enter driver"
            },
        }
        handleFormValidateWithMsg(form, rules, message, function(form) {
            handleAjaxFormSubmit(form, true);
        });
    }

    return {
        init: function() {
            smtp();
        }
    }
}();
