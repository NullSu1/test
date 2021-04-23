<table border="1">
    <tr>
        <td>我的</td>
        <td><?= $_SESSION['user']; ?></td>
    </tr>
    <tr>
        <td>卖家</td>
        <td><?= $result['author']; ?></td>
    </tr>
    <tr>
        <td>订单号</td>
        <td><?= $order; ?></td>
    </tr>
    <tr>
        <td>书籍:</td>
        <td>
            <table border="1">
                <tr>
                    <td>书名</td>
                    <td><?= $result['book_name']; ?></td>
                </tr>
                <tr>
                    <td>封面</td>
                    <td><img src="<?= $result['cover_art']; ?>" height="75" width="100"></td>
                </tr>
                <tr>
                    <td>售价</td>
                    <td><?= $result['pri']; ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>