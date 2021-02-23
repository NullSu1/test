<?php
error_reporting(0);

/**
 * @param $length
 * @param bool $type
 * @return string
 */
function getCode($length, $type = true)
{
	if ($type) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	} else {
		$characters = '0123456789';
	}
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}


/**
 * @param $data
 * @param $key
 * @return string
 */
function encrypt($data, $key)
{
	$key = md5($key);
	$x = 0;
	$len = strlen($data);
	$l = strlen($key);
	for ($i = 0; $i < $len; $i++) {
		if ($x == $l) {
			$x = 0;
		}
		$char .= $key{$x};
		$x++;
	}
	for ($i = 0; $i < $len; $i++) {
		$str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
	}
	return base64_encode($str);
}

/**
 * 解密数据
 * @param $data
 * 密钥
 * @param $key
 * 返回解密后的字符
 * @return string
 */
function decrypt($data, $key)
{
	$key = md5($key);
	$x = 0;
	$data = base64_decode($data);
	$len = strlen($data);
	$l = strlen($key);
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

/**
 * 解密数据
 * @param $string
 * @param string $key
 * @param bool $operation
 * @param int $expiry
 * @return string
 */
function authcode($string, $key = '', $operation = false, $expiry = 0)
{
	$ckey_length = 4;
	$key = md5($key ? $key : "DEFAULT_KEYS");
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

	$cryptkey = $keya . md5($keya . $keyc);
	$key_length = strlen($cryptkey);
	$string = $operation ? base64_decode(substr($string, $ckey_length)) :
		sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
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

function substrCount($string, $needle)
{
	$str_len = strlen($string);
	$ned_len = strlen($needle);
	$num = 0;

	for ($i = 0; $i <= ($str_len - $ned_len); $i++) {
		if ($string[$i] == $needle[0]) {
			$check = substr($string, $i, $ned_len);
			if ($check == $needle)
				$num++;
		}
	}
	return $num;
}


//$fileName = "backiee.jpg";
//$file = "http://192.168.6.75/test/bootstrap/img/" . $fileName;
//
////$fileContents = file_get_contents($file);
//if (!$fileContents = file_get_contents($file)) {
//	echo "<script>alert('打开文件失败')</script>";
//}
//header('Content-Type:text/html;charset=utf-8');
//header('Content-Length: ' . (strlen($fileContents)));
//header('Content-Disposition: attachment; filename=' . $fileName);
//
//exit($fileContents);


if(!empty($_POST['data'])){
	echo authcode($_POST['data'],'key2w3o9u', true);
	exit;
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    var choose = 'choose';
    $.ajax({
        url:'likou.php',
        type: "POST",
        data:{'data':
                "<?= authcode(sprintf('%0128d', '0')."\" . rewrwe . \"",'key2w3o9u');?>"
        },
	    success: function(res){
            console.log(res);
	    }
    })
</script>
