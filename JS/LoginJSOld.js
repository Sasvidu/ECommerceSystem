function showPasswordFunction(){

    let field = document.getElementById('password');
    let icon = document.getElementById('eye-icon');

    if(field.type=="password"){
        field.type="text";
        icon.className="fa-solid fa-eye-slash";
    }else if(field.type=="text"){
        field.type="password";
        icon.className="fa-solid fa-eye";
    }

}

let dateBox = document.getElementById('dateBox');

function getTime(){

    var timeNow = new Date();
    var h = timeNow.getHours();
    var m = timeNow.getMinutes();
    var s = timeNow.getSeconds();

    var time = h.toString() + " : " + m.toString() + " : " + s.toString();

    dateBox.innerHTML=time;

}

setInterval(getTime,1000);

function getEmailHelper(){
    document.getElementById('emailHelper').innerHTML="We'll never share your email with anyone else.";
}

function removeAlertBox(){
    var alertBox = document.getElementById('alertBox');
    var alert = document.getElementById('alert');
    alert.innerHTML=null;
    alertBox.classList.remove("alert");
    alertBox.classList.remove("alert-danger");
}

let username = document.getElementById('username');
let password = document.getElementById('password');

username.addEventListener("click", removeAlertBox);
password.addEventListener("click", removeAlertBox);

/*
function emptyInputUP(){

    let field1 = document.getElementById('username');
    let field2 = document.getElementById('password');

    field1.classList.add("emptyInput");
    field2.classList.add("emptyInput");

}
*/