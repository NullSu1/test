
<div class="script">
    <p>123</p>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    function mGetDate(year,month) {
        var d = new Date(year,month,0);
        return d.getDate();
    }

    function getTimetips(){
        var myDate = new Date();
        y = myDate.getFullYear();
        m = myDate.getMonth()+1;
        d = myDate.getDate();
        console.log(y + "-" + m + "-" + d);
        console.log(d)
        if(d < 15){
            console.log(y + "年" + m + "月15日まで")
        }else{
            console.log(y + "年" + m + "月" + mGetDate(y,m) + "日まで");
        }
    }
    getTimetips()
</script>
<?php
var_dump($_SESSION);
?>
