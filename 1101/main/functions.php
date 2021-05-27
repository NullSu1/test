<?php
function authcode(string $string, $key = '', $operation = false, $expiry = 0): string
{
    $ckey_length = 4;
    $key = md5($key ? $key : "DEFAULT_KEYS");
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

    $cryptkey = $keya . md5($keya . $keyc);
    $key_length = strlen($cryptkey);
    $string = $operation ? base64_decode(substr($string, $ckey_length)) :
        sprintf('%010d', ($expiry ? $expiry + time() : 0)) . substr(md5($string . $keyb), 0, 16) . $string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    for ($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if ($operation) {
        if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) &&
            substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc . str_replace('=', '', base64_encode($result));
    }
}

function CheckLog(){
    if(empty($_SESSION['user'])){

        return false;
    }
    if($_SESSION['expiretime'] < time()) {

        unset($_SESSION['expiretime']);

        header('Location: logout.php?TIMEOUT'); // 登出

        return false;
    }
    $_SESSION['expiretime'] = time() + 3600;

    return true;
}

/**
 * 返回加密后的字符
 *
 * @param $data
 * 加密数据
 * @param $key
 * 密钥
 * @return string
 */
function encrypt($data, $key): string
{
    $key = md5($key);
    $x = 0;
    $len = strlen($data);
    $l = strlen($key);
    $char = '';
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) {
            $x = 0;
        }
        $char .= $key[$x];
        $x++;
    }
    for ($i = 0; $i < $len; $i++) {
        $str .= chr(ord($data[$i]) + (ord($char[$i])) % 256);
    }
    return base64_encode($str);
}

/**
 * 返回解密后的字符
 *
 * @param $data
 * 解密数据
 * @param $key
 * 密钥
 * @return string
 */
function decrypt($data, $key): string
{
    $key = md5($key);
    $x = 0;
    $data = base64_decode($data);
    $len = strlen($data);
    $l = strlen($key);
    $char = '';
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        if ($x == $l) {
            $x = 0;
        }
        $char .= substr($key, $x, 1);
        $x++;
    }
    for ($i = 0; $i < $len; $i++) {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1))) {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        } else {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return $str;
}
