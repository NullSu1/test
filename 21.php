<span style="background: url(./bootstrap/img/backiee.jpg)"></span>
<div class="script">
    <p><?= $_GET['num']; ?></p>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    $(function(){
        $(".script").on({
            mouseover : function(){
                $(this).text(mGetDate(2021,2));
            } ,
            mouseout : function(){
                $(this).html('123') ;
            }
        }) ;
    }) ;
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

</script>
