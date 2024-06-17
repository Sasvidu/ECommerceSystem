    function openEditJobModal(id){

        $(document).ready(function(){
            var fields = id.split('t');
            var JobId = fields[1];
            
            var JobName = "JobName";
            JobName = JobName.concat(JobId);
            JobName = document.getElementById(JobName).innerText;
    
            var JobDepartment = "JobDepartment";
            JobDepartment = JobDepartment.concat(JobId);
            JobDepartment = document.getElementById(JobDepartment).innerText;
    
            var JobDescription = "JobDescription";
            JobDescription = JobDescription.concat(JobId);
            JobDescription = document.getElementById(JobDescription).innerHTML;
    
            var JobSalary = "JobSalary";
            JobSalary = JobSalary.concat(JobId);
            JobSalary = document.getElementById(JobSalary).innerText;
    
            var JobOT = "JobOT";
            JobOT = JobOT.concat(JobId);
            JobOT = document.getElementById(JobOT).innerText;
    
    
            $("#EditJobModal").modal();
            $(".modal-body #JobId").val(JobId);
            $(".modal-body #JobName").val(JobName);
            $(".modal-body #JobDepartment").val(JobDepartment);
            $(".modal-body #JobDescription").val(JobDescription);
            $(".modal-body #JobSalary").val(JobSalary);
            $(".modal-body #JobOT").val(JobOT);
        })
        
    }
    
    function openDeleteJobModal(id){
    
        $(document).ready(function(){
            var fields = id.split('l');
            var JobId = fields[1];
        
            $("#DeleteJobModal").modal();
            $(".modal-body #JobId").val(JobId);
        })
    
    }

    
    function changeLimits(){

        $( document ).ready(function() {

            var limit = document.getElementById("limitSelector");
            limit = limit.value;

            $(".limitSelectForm").submit();
            
        });

    }
