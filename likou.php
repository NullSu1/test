<?php

// 设置一个公钥(key)和私钥(secret)，公钥用于区分用户，私钥加密数据，不能公开

$key = MD5(md5(time()) . '1q2w3e');
$secret = MD5(md5(time()) . '4r5t6y');

// 待发送的数据包

$data = array('username' => 'abc@qq.com', 'sex' => '1', 'age' => '16', 'addr' => 'guangzhou', 'key' => $key, 'timestamp' => time(),);

// 获取sign

//die();

function getSign($secret, $data)
{

// 对数组的值按key排序

    ksort($data);

// 生成url的形式

    $params = http_build_query($data);

// 生成sign

    $sign = md5($params . $secret);
    return $sign;
}

// 发送的数据加上sign


/** * 后台验证sign是否合法 *@param[type] $secret [description] *@param[type] $data  [description] *@return[type]        [description] */

function verifySign($secret, $data)
{

//验证参数中是否有签名

    if (!isset($data['sign']) || !$data['sign']) {
        echo '413 发送的数据签名不存在';
        die();

    }

    if (!isset($data['timestamp']) || !$data['timestamp']) {
        echo '发送的数据参数不合法';
        die();

    }

// 验证请求， 10分钟失效

    if (time() - $data['timestamp'] > 600) {

        echo '408 验证失效， 请重新发送请求';
        die();

    }

    $sign = $data['sign'];

    unset($data['sign']);

    ksort($data);

    $params = http_build_query($data);

// $secret是通过key在api的数据库中查询得到

    $sign2 = md5($params . $secret);
    if ($sign == $sign2) {
        echo ('200 验证通过');
    } else {
        echo ('请求不合法');
    }
}

//$data['sign'] = getSign($secret, $data);
var_dump($data);
for($i = 0; $i < 3; $i++){
    verifySign($secret,$data);
    echo "<br>";
}
