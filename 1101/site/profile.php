<form method="post">
    <table border="1">
        <tr>
            <td>id</td>
            <td><input type="text" disabled value="<?= $re[0]['id']; ?>"></td>
        </tr>
        <tr>
            <td>姓名</td>
            <td><input type="text" value="<?= $re[0]['user']; ?>"></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" value="<?= $password; ?>"></td>
        </tr>
        <tr>
            <td>余额</td>
            <td>
                <input type="text" disabled value="<?= $re[0]['balance']; ?>" style="width: 50px">
                <button style="float: right;"><a href="#">充值</a></button>
            </td>
        </tr>
        <tr>
            <td>注册时间</td>
            <td><input type="text" value="<?= $re[0]['date']; ?>"></td>
        </tr>
    </table>
    <br>
    <input type="submit" name="sub" value="确定">
    <button onclick="f()">返回</button>
</form>
<script>
    function f() {
        history.go(-1)
    }
</script>