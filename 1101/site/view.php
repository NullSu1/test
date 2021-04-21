<?php
include_once "header.php";
$page = empty($_GET['page']) ? 1 : $_GET['page'];
$MysqlQuery = new MysqlQuery($db_book);
$classlists = $MysqlQuery->getLists('class', '', 'td_demo02');
$date = date('Y-m-d H:i:s');
$sql = "INSERT INTO `td_demo02`(`book_name`, `pri`, `out_time`, `class`) VALUES ('A Brief History of Time','40', '$date', '物理')";
?>
<form method="get" action="?class=<?= $_POST['class']; ?>">
    <input id="bookname" type="text" name="book" value="<?php if(!empty($_GET['book'])) echo $_GET['book'];?>" placeholder="请输入书名">
    <select name="class">
        <option value="">不限</option>
        <?php foreach ($classlists as $item): ?>
        <option value="<?= $item['class']; ?>" <?php if($item['class'] == $_GET['class']) echo 'selected'?>><?= $item['class']; ?></option>
        <?php endforeach; ?>
    </select>
    <input id="submit" type="submit">
</form>
<table id="table" width="799" height="200" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" valign="middle">

            <table width="90%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#CCCCCC">
                <tr>
                    <td width="30%" align="center">书名</td>
                    <td width="30%" align="center">封面</td>
                    <td width="10%" align="center">价格</td>
                    <td width="20%" align="center">出版时间</td>
                    <td width="10%" align="center">类别</td>
                    <td width="10%" align="center">操作</td>
                </tr>
                <?php
                try {
                    $sqlstr = "SELECT `id`, `book_name`, `pri`, `out_time`, `class` FROM `td_demo02` WHERE 1 ";

                    $search = empty($_GET['book']) ? '' : " and book_name like '%".$_GET['book']."%'";;

                    $class = empty($_GET['class']) ? '' : " and class = '".$_GET['class']."'";

                    $sqlstr = $sqlstr . $class . $search;

                    $result = $MysqlQuery->Paging($sqlstr,'3');

                    foreach ($result as $re) :?>
                        <tr>
                            <td width="30%" align="center" bgcolor="#FFFFFF"><?= $re['book_name']; ?></td>
                            <td width="30%" align="center" bgcolor="#FFFFFF"><?= $re['book_name']; ?></td>
                            <td width="10%" align="center" bgcolor="#FFFFFF"><?= $re['pri']; ?></td>
                            <td width="20%" align="center" bgcolor="#FFFFFF"><?= $re['out_time']; ?></td>
                            <td width="10%" align="center" bgcolor="#FFFFFF"><?= $re['class']; ?></td>
                            <td width="10%" align="center" bgcolor="#FFFFFF"><a href="">操作</a></td>
                        </tr>
                    <?php endforeach;
                } catch (mysqli_sql_exception $e) {

                    echo $sqlstr;

                    die('Line ' . __LINE__ . ' : ' . $e->getMessage());
                }
                ?>

                <tr>
                    <td height="25" colspan="6" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;
                        <?php $MysqlQuery->Paging($sqlstr,'3', false); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php include_once "footer.php"; ?>

