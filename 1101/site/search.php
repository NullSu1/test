<?php
include_once "header.php";
include_once "main/conn.php";
$page = empty($_GET['page']) ? 1 : $_GET['page'];
?>
<div class="search">
    <h1>简单查询</h1>
    <form method="post">
    <input id="bookname" type="text" name="book" placeholder="请输入书名">
    <input id="submit" type="submit" name="sub">
    </form>
    <table width="799" height="200" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" valign="middle">
                <table width="90%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF"
                       bgcolor="#CCCCCC">
                    <tr>
                        <td width="5%" height="25" align="center">id</td>
                        <td width="30%" align="center">书名</td>
                        <td width="10%" align="center">价格</td>
                        <td width="20%" align="center">出版时间</td>
                        <td width="10%" align="center">类别</td>
                        <td width="10%" align="center">操作</td>
                    </tr>
					<?php
                    error_reporting(0);

					if (isset($_POST['sub'])):
						echo $_POST['book'];
						try {
							$book = $_POST['book'];

							$sql_search = "select * from td_demo02 where book_name like '%$book%'";//定义查询语句

							$result = Sql_fe($conn, $sql_search);

							while ($rows = mysqli_fetch_assoc($result)):?>

                                <tr>
                                    <td width="5%" height="25" align="center" bgcolor="#FFFFFF"><?php echo $rows['id']; ?></td>
                                    <td width="30%" align="center" bgcolor="#FFFFFF"><?php echo $rows['book_name']; ?></td>
                                    <td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $rows['pri']; ?></td>
                                    <td width="20%" align="center" bgcolor="#FFFFFF"><?php echo $rows['out_time']; ?></td>
                                    <td width="10%" align="center" bgcolor="#FFFFFF"><?php echo $rows['class']; ?></td>
                                    <td width="10%" align="center" bgcolor="#FFFFFF">操作</td>
                                </tr>
							<?php
                            endwhile;
						} catch (mysqli_sql_exception $e) {

					        var_dump($sql_search);

							die('Line ' . __LINE__ . ' : ' . $e->getMessage());
						}
					endif;?>
                    <tr>
                        <td height="25" colspan="6" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;
	                        <?php $paging->Sql_fe($totalNum, $page, $pagecount) ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<?php include_once "footer.php" ?>