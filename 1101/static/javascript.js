function timeShow(){
    var date = new Date();
    $("#date").html(date);
    setTimeout('timeShow()',1000);
}
timeShow();