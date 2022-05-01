var Contactus = function(){

    var add = function(){
        var form = $('#contact-form');
        var rules = {
            name: {required: true},
            lastname: {required: true},
            email: {required: true,email:true},
        };

        var message = {
            name: {required: "Please enter your name"},
            lastname: {required: "Please enter last name"},
            email: {required: "Please enter your email",email:"Please enter vaild email"},
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    return {
        init:function(){
            add();
        }
    }
}();
