<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>

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

