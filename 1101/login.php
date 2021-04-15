<?php require_once "header.php"?>
<form method="post" style="text-align: center">
    <input type="text" name="one" placeholder="user name" required><br><br>
    <input type="text" name="pwd" placeholder="user passwd" required><br><br>
    <input type="submit" name="sub" value="sign in">
</form>
<button id="up">sign up</button>
<script>

    $("#up").click(function () {
        console.log($("input[name='one']").val());
    });
</script>
<?php require_once "footer.php"; ?>
