<?php $class_li = ['php', 'javascript', 'type', 'javs', 'python', 'other']; ?>
<div>
    <form method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>书名</td>
                <td><input type="text" name="book_name" required></td>
            </tr>
            <tr>
                <td>封面</td>
                <td><input type="file" name="file" required></td>
            </tr>
            <tr>
                <td>价格</td>
                <td><input type="number" name="pri" required></td>
            </tr>
            <tr>
                <td>类别</td>
                <td>
                    <select name="class" required>
                        <option value="">---option---</option>
                        <?php foreach ($class_li as $item): ?>
                        <option value="<?= $item; ?>"><?= $item; ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr><td colspan="2" style="text-align: center"><input type="submit" name="sub"></td></tr>
        </table>
    </form>
</div>
