<form method="get" action="?action=<?= $_GET['action']; ?>">
    <input type="hidden" name="action" value="<?= $_GET['action']; ?>">
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
                    <td width="20%" align="center">封面</td>
                    <td width="10%" align="center">价格</td>
                    <td width="20%" align="center">出版时间</td>
                    <td width="10%" align="center">类别</td>
                    <td width="10%" align="center">操作</td>
                </tr>
                <?php

                $search = empty($_GET['book']) ? '' : " and `td_demo02`.`book_name` like '%".$_GET['book']."%'";;

                $class = empty($_GET['class']) ? '' : " and `td_demo02`.`class` = '".$_GET['class']."'";

                $sql = $sql . $class . $search;

                $result = $MysqlQuery->Paging($sql,'5');

                foreach ($result as $re) :?>
                    <tr>
                        <td width="30%" align="center" bgcolor="#FFFFFF"><?= $re['book_name']; ?></td>
                        <td width="20%" align="center" bgcolor="#FFFFFF"><img src="<?= $re['cover_art'];?>" height="55" width="100"></td>
                        <td width="10%" align="center" bgcolor="#FFFFFF"><?= $re['pri']; ?></td>
                        <td width="20%" align="center" bgcolor="#FFFFFF"><?= $re['out_time']; ?></td>
                        <td width="10%" align="center" bgcolor="#FFFFFF"><?= $re['class']; ?></td>
                        <td width="10%" align="center" bgcolor="#FFFFFF"><a href="?action=transaction&id=<?= $re['id']; ?>">操作</a></td>
                    </tr>
                <?php endforeach; ?>

                <tr>
                    <td height="25" colspan="6" align="left" bgcolor="#FFFFFF">&nbsp;&nbsp;
                        <?php $MysqlQuery->Paging($sql,'5', false); ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>