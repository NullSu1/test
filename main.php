<?php
// 待发送的数据包
$secret = MD5(md5('time()') . '4r5t6y');

$data = array('username' => 'abc@qq.com', 'sex' => '1', 'age' => '16', 'addr' => 'guangzhou', 'timestamp' => time());

// 获取sign


// 发送的数据加上sign
//$data['sign'] = getSign($secret, $data);
?>
<html>
<form method="post" action="likou.php">
    <input type="hidden" name="sign" value="<?= $data; ?>">
    <button type="submit" name="sub">click</button>
</form>
</html>