(function ($) {
    "use strict";

    
    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');

    $('.validate-form').on('submit',function(){
        var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;
    });


    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
    
    

})(jQuery);

function showPasswordFunction(){

    let field = document.getElementById('password');
    let icon = document.getElementById('eye-icon1');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}

function showRePasswordFunction(){

    let field = document.getElementById('Repassword');
    let icon = document.getElementById('eye-icon2');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}