$(document).ready(function(){

    $('#messageContent').mouseenter(function(){
        $(this).css({transition: '0.5s', color: 'blue'});
    });

    $('#messageContent').mouseleave(function(){
        $(this).css({transition: '0.5s', color: 'black'});
    });

});