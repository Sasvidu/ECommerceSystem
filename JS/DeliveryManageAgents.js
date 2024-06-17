function openEditModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("t");
        var agentId = fields[1];

        var agentName = "AgentName";
        agentName = agentName.concat(agentId);
        agentName = document.getElementById(agentName).innerText;

        var agentLocation = "AgentLocation";
        agentLocation = agentLocation.concat(agentId);
        agentLocation = document.getElementById(agentLocation).innerText;
        
        var agentAddress = "AgentAddress";
        agentAddress = agentAddress.concat(agentId);
        agentAddress = document.getElementById(agentAddress).innerText;

        $("#EditAgentModal").modal();
        $(".modal-body #AgentId").val( agentId );
        $(".modal-body #AgentName").val( agentName );
        $(".modal-body #AgentLocation").val( agentLocation );
        $(".modal-body #AgentAddress").val( agentAddress );
        
    });
  
}

function openDeleteModal(id){
    
    $( document ).ready(function() {

        var fields = id.split("l");
        var agentId = fields[1];
        $("#DeleteAgentModal").modal();
        $(".modal-body #Id").val( agentId );
        
    });
  
}

function changeLimits(){

    $( document ).ready(function() {

        var limit = document.getElementById("limitSelector");
        limit = limit.value;

        $(".limitSelectForm").submit();
        
    });

}
