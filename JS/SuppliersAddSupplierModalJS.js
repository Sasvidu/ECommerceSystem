var Emails = document.getElementById("EmailsContainer");
var addEmails = document.getElementById("addEmails");
var removeEmails = document.getElementById("removeEmails");

var TelNos = document.getElementById("TelNosContainer");
var addTelNos = document.getElementById("addTelNos");
var removeTelNos = document.getElementById("removeTelNos");

function AddEmailField(){
    var newEmailField = document.createElement('input');
    newEmailField.setAttribute('type', 'email');
    newEmailField.setAttribute('name', 'Emails[]');
    newEmailField.setAttribute('class', 'form-control');
    newEmailField.setAttribute('placeholder', 'Alternate email address of the supplier');
    newEmailField.setAttribute('style', 'margin-top:7px; margin-bottom:7px');
    Emails.appendChild(newEmailField);
}

function RemoveEmailField(){
    var inputTags = Emails.getElementsByTagName('input');
    if(inputTags.length>1){
        Emails.removeChild(inputTags[inputTags.length-1]);
    }
}

function AddTelnoField(){
    var NewTelnoField = document.createElement('input');
    NewTelnoField.setAttribute('type', 'number');
    NewTelnoField.setAttribute('name', 'TelNos[]');
    NewTelnoField.setAttribute('class', 'form-control');
    NewTelnoField.setAttribute('placeholder', 'Alternate telephone number of the supplier');
    NewTelnoField.setAttribute('style', 'margin-top:7px; margin-bottom:7px');
    TelNos.appendChild(NewTelnoField);
}

function RemoveTelNoField(){
    var inputTags = TelNos.getElementsByTagName('input');
    if(inputTags.length>1){
        TelNos.removeChild(inputTags[inputTags.length-1]);
    }
}
