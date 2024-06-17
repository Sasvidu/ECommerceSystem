function showPasswordFunction(){

    let field = document.getElementById('Password');
    let icon = document.getElementById('eye-icon6');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}

function showRePasswordFunction(){

    let field = document.getElementById('RePassword');
    let icon = document.getElementById('eye-icon7');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}