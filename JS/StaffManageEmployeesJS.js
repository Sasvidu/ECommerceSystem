function openEditEmpModal(id){

    $(document).ready(function(){
        var fields = id.split('t');
        var EmpId = fields[1];
        
        var EmpName = "EmpName";
        EmpName = EmpName.concat(EmpId);
        EmpName = document.getElementById(EmpName).innerText;

        var NameFields = EmpName.split(' ');
        var EmpFName = NameFields[0];
        var EmpLName = NameFields[1];

        var JobId = "JobId";
        JobId = JobId.concat(EmpId);
        JobId = document.getElementById(JobId).innerText;
        
        var EmpAddress = "EmpAddress";
        EmpAddress = EmpAddress.concat(EmpId);
        EmpAddress = document.getElementById(EmpAddress).innerHTML;

        var EmpDOB = "EmpDOB";
        EmpDOB = EmpDOB.concat(EmpId);
        EmpDOB = document.getElementById(EmpDOB).innerText;

        var EmpNIC = "EmpNIC";
        EmpNIC = EmpNIC.concat(EmpId);
        EmpNIC = document.getElementById(EmpNIC).innerText;

        var EmpEmail1 = "EmpEmail1";
        EmpEmail1 = EmpEmail1.concat(EmpId);
        EmpEmail1 = document.getElementById(EmpEmail1).innerText;

        var EmpEmail2 = "EmpEmail2";
        EmpEmail2 = EmpEmail2.concat(EmpId);
        EmpEmail2 = document.getElementById(EmpEmail2).innerText;

        var EmpTel1 = "EmpTel1";
        EmpTel1 = EmpTel1.concat(EmpId);
        EmpTel1 = document.getElementById(EmpTel1).innerText;

        var EmpTel2 = "EmpTel2";
        EmpTel2 = EmpTel2.concat(EmpId);
        EmpTel2 = document.getElementById(EmpTel2).innerText;

        if(EmpEmail2 == "N/A"){
            EmpEmail2 = "";
        }

        if(EmpTel2 == "N/A"){
            EmpTel2 = "";
        }

        $("#EditEmployeeModal").modal();
        $(".modal-body #EmpId").val(EmpId);
        $(".modal-body #EmpFName").val(EmpFName);
        $(".modal-body #EmpLName").val(EmpLName);
        $(".modal-body #EmpJobId").val(JobId);
        $(".modal-body #EmpAddress").val(EmpAddress);
        $(".modal-body #EmpDOB").val(EmpDOB);
        $(".modal-body #EmpNIC").val(EmpNIC);
        $(".modal-body #EmpEmail1").val(EmpEmail1);
        $(".modal-body #EmpEmail2").val(EmpEmail2);
        $(".modal-body #EmpTel1").val(EmpTel1);
        $(".modal-body #EmpTel2").val(EmpTel2);

    })
    
}

function openDeleteEmpModal(id){

    $(document).ready(function(){
        var fields = id.split('l');
        var EmpId = fields[1];
    
        $("#DeleteEmployeeModal").modal();
        $(".modal-body #EmpId").val(EmpId);
    })

}

function changeLimits(){

    $( document ).ready(function() {

        var limit = document.getElementById("limitSelector");
        limit = limit.value;

        $(".limitSelectForm").submit();
        
    });

}
