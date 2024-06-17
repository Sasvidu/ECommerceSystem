function showNewPasswordFunction1(){

    let field = document.getElementById('NewPassword1');
    let icon = document.getElementById('eye-icon1');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}

function showRePasswordFunction1(){

    let field = document.getElementById('Repassword1');
    let icon = document.getElementById('eye-icon2');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}

function showCurrentPasswordFunction(){

    let field = document.getElementById('CurrentPassword');
    let icon = document.getElementById('eye-icon3');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}

function showNewPasswordFunction2(){

    let field = document.getElementById('NewPassword2');
    let icon = document.getElementById('eye-icon4');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}

function showRePasswordFunction2(){

    let field = document.getElementById('Repassword2');
    let icon = document.getElementById('eye-icon5');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}