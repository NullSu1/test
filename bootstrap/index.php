
<div id="time" onclick="f()">时间</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>

    function f() {
        date = new Date();
        $("#time").html('<a href="img/backiee.jpg">'+date.toTimeString()+'</a>');
        setTimeout('f()',1000);
    }

    $.ajax({
        type: 'POST',
        url: 'https://ld.iobit.com/newsletter/2020hibella/fbApi.php',
        data: {'data': "<?= base64_encode(json_encode(["Congratulations"=>["fbid"=>'2803969269842527']]))?>"},
        // data: {'data': "eyJyYW5rIjp7InBhZ2UiOjEsInJvdyI6NX19"},
        success: function (res) {
            console.log(JSON.parse(res));
        }
    })
</script>

