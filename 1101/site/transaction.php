用户:<?= $_SESSION["user"] ?><br>余额:<?= $_SESSION['balance']; ?>
<table width="90%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#CCCCCC">
    <tr>
        <td width="30%" align="center">书名</td>
        <td width="20%" align="center">封面</td>
        <td width="10%" align="center">价格</td>
        <td width="20%" align="center">出版时间</td>
        <td width="10%" align="center">类别</td>
        <td width="10%" align="center">发布者</td>
    </tr>
    <tr>
        <td width="30%" align="center" bgcolor="#FFFFFF"><?= $result['book_name']; ?></td>
        <td width="20%" align="center" bgcolor="#FFFFFF"><img src="<?= $result['cover_art']; ?>" height="75" width="100">
        </td>
        <td width="10%" align="center" bgcolor="#FFFFFF"><?= $result['pri']; ?></td>
        <td width="20%" align="center" bgcolor="#FFFFFF"><?= $result['out_time']; ?></td>
        <td width="10%" align="center" bgcolor="#FFFFFF"><?= $result['class']; ?></td>
        <td width="10%" align="center" bgcolor="#FFFFFF"><?= $result['author']; ?></td>
    </tr>
</table>
<form method="post" action="?action=order&id=<?= $result['id']; ?>">
<!--    <input type="hidden" name="id" value="--><?//= $result['id']; ?><!--">-->
    <input type="submit" value="购买">
</form>

