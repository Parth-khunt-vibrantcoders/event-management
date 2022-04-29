var Login = function(){
    var signin = function(){
        var form = $('#signin');
        var rules = {
            email: {required: true,email:true},
            password: {required: true},
        };

        var message = {
            email :{
                required : "Please enter your register email address",
                email: "Please enter valid email address"
            },
            password : {
                required : "Please enter password"
            }
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    var signupform = function(){
        var form = $('#signup');
        var rules = {
            email: {required: true,email:true},
            password: {required: true},
            firstname: {required: true},
            lastname: {required: true},
            confirm_password: {
                required: true,
                equalTo: "#password"
            }
        };

        var message = {
            email :{
                required : "Please enter your register email address",
                email: "Please enter valid email address"
            },
            password : {
                required : "Please enter password"
            },
            firstname : {
                required : "Please enter first name"
            },
            lastname : {
                required : "Please enter last name"
            },
            confirm_password : {
                required : "Please enter password confirm",
                equalTo: 'Confirm Password must be same as password'
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    return {
        init : function(){
            signin();
        },
        signup:function(){
            signupform();
        }
    }
}();
