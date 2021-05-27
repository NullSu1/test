<table id="table" width="799" height="200" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center" valign="middle">

            <table width="90%" border="1" cellpadding="1" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#CCCCCC">
                <tr>
                    <td width="20%" align="center">商品</td>
                    <td width="30%" align="center">订单号</td>
                    <td width="20%" align="center">时间</td>
                    <td width="10%" align="center">状态</td>  
                    <td width="10%" align="center">操作</td>
                </tr>
                <?php
                $sqlstr = "SELECT `order`.*, `td_demo02`.`book_name` FROM `order` join `td_demo02` on `order`.`book_id`=`td_demo02`.`id` WHERE user='$user'";

                $result = $MysqlQuery->Paging($sqlstr,'5');

                foreach ($result as $re) :?>
                    <tr>
                        <td width="20%" align="center" bgcolor="#FFFFFF"><?= $re['book_name']; ?></td>
                        <td width="30%" align="center" bgcolor="#FFFFFF"><?= $re['order']; ?></td>
                        <td width="20%" align="center" bgcolor="#FFFFFF"><?= $re['date'];?></td>
                        <td width="10%" align="center" bgcolor="#FFFFFF"><?= $re['stats']; ?></td>
                        <td width="10%" align="center" bgcolor="#FFFFFF"><a href="?action=order&id=<?= $re['book_id']; ?>">操作</a></td>
                    </tr>
                <?php endforeach; ?>

                <tr>
                    <td height="25" colspan="6" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;
                        <?php $MysqlQuery->Paging($sqlstr,'5', false); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>