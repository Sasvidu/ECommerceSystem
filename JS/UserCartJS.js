function qtyMinus(productId){



        let qtyCounter = "qtyCounter";
        qtyCounter = qtyCounter.concat(productId);

        qty = document.getElementById(qtyCounter).value;
        qty = parseInt(qty);

        if(qty > 1){
            qty -= 1;
            document.getElementById(qtyCounter).value = qty;
        }

        let qtySubmitCode = String(productId);
        qtySubmitCode = qtySubmitCode.concat("-");
        qtySubmitCode = qtySubmitCode.concat(qty);

        let qtySubmit = "qtySubmit";
        qtySubmit = qtySubmit.concat(productId);
        document.getElementById(qtySubmit).value = qtySubmitCode;

    

}

$(document).ready(function(){

    $('.plusbtn').click(function(e){

        cardId = e.currentTarget.id;
        maxQty = e.currentTarget.value;

        let qtyCounter = "qtyCounter";
        qtyCounter = qtyCounter.concat(cardId);

        qty = document.getElementById(qtyCounter).value;
        qty = parseInt(qty);

        if(qty < maxQty){
            qty += 1;
            document.getElementById(qtyCounter).value = qty;
        }

        let qtySubmitCode = String(cardId);
        qtySubmitCode = qtySubmitCode.concat("-");
        qtySubmitCode = qtySubmitCode.concat(qty);

        let qtySubmit = "qtySubmit";
        qtySubmit = qtySubmit.concat(cardId);
        document.getElementById(qtySubmit).value = qtySubmitCode;

        $('#cartForm').submit();

    })

    $('.minusbtn').click(function(e){

        cardId = e.currentTarget.id;

        let qtyCounter = "qtyCounter";
        qtyCounter = qtyCounter.concat(cardId);

        qty = document.getElementById(qtyCounter).value;
        qty = parseInt(qty);

        if(qty > 1){
            qty -= 1;
            document.getElementById(qtyCounter).value = qty;
        }

        let qtySubmitCode = String(cardId);
        qtySubmitCode = qtySubmitCode.concat("-");
        qtySubmitCode = qtySubmitCode.concat(qty);

        let qtySubmit = "qtySubmit";
        qtySubmit = qtySubmit.concat(cardId);
        document.getElementById(qtySubmit).value = qtySubmitCode;

        $('#cartForm').submit();

    })

})