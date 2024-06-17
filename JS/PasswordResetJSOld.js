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

let dateBox = document.getElementById('dateBox');

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

let fname = document.getElementById("Fname");
let lname = document.getElementById("Lname");
let email = document.getElementById("Email");
let dob = document.getElementById("dob");
let nic = document.getElementById("nic");
let pwd = document.getElementById("password");
let Repwd = document.getElementById("Repassword");

fname.addEventListener("click", removeAlertBox);
lname.addEventListener("click", removeAlertBox);
email.addEventListener("click", removeAlertBox);
dob.addEventListener("click", removeAlertBox);
nic.addEventListener("click", removeAlertBox);
pwd.addEventListener("click", removeAlertBox);
Repwd.addEventListener("click", removeAlertBox);