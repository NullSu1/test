<?php
/**
 * @param $length
 * @param bool $type
 * @return string
 */
function getCode($length, $type = true): string
{
	if ($type) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz'.strtoupper('abcdefghijklmnopqrstuvwxyz');
	} else {
		$characters = '0123456789';
	}
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

echo getCode(12);
/**
 * @param $end
 * @param $start
 * @return string
 */
function timeDiff($end, $start): string
{
	$diff = $end - $start;
	$y = intval($diff / (60 * 60 * 24 * 30 * 12));
	$diff -= $y * 60 * 60 * 24 * 30 * 12;
	$m = intval($diff / (60 * 60 * 24 * 30));
	$diff -= $m * 60 * 60 * 24 * 30;
	$d = intval($diff / (60 * 60 * 24));
	$diff -= $d * 60 * 60 * 24;
	$h = intval($diff / (60 * 60));
	$diff -= $h * 60 * 60;
	$i = intval($diff / 60);
	return $y . "年" . $m . "月" . $d . "天" . $h . "时" . $i . "分";
}
echo timeDiff('1624118399','1621423064');
/**
 * @param $str
 * @return string|string[]
 */
function str_check($str)
{
	$str = addslashes($str);
	$str = htmlspecialchars($str, ENT_QUOTES);
	$str = str_replace(' ', '-', trim($str));
	return $str;
}

/**
 * @param $email
 * @param $title
 * @param $body
 * @return bool|string
 */
function sendMail($email, $title, $body)
{
	$url = "http://interface.iobit.com/mail/";

	$post_data['subject'] = $title;
	$post_data['body'] = $body;
	$post_data['tname'] = "";
	$post_data['email'] = $email;
	$post_data['fname'] = "IObit";
	$post_data['femail'] = "iobitfacebook@iobit.com";
	$post_data['slat'] = '8dcdbc87be2dc42dd3ec9cae301a12d3';
	$post_data['attachment'] = 0;
	//$post_data['callback'] 		= "http://test.iobit.com/pwei/test_mail_api/return.php";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_REFERER, 'http://www.iobit.com/');
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	$response = curl_exec($ch);
	curl_close($ch);
	return $response;
}

/**
 * @return mixed|string
 */
function getIP(): string
{
	if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
		$cip = $_SERVER["HTTP_CLIENT_IP"];
	} elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		$ip_arr = explode(',', $_SERVER["HTTP_X_FORWARDED_FOR"]);
		$cip = $ip_arr[0];
	} elseif (!empty($_SERVER["REMOTE_ADDR"])) {
		$cip = $_SERVER["REMOTE_ADDR"];
	} else {
		$cip = '';
	}
	return $cip;
}

/**
 * @param $email
 * @return false
 */
function mail_check($email): bool
{
	if (!preg_match("^[_\.0-9a-z+-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$^", $email)) {
		return false;
	}
	return $email;
}

/**
 * @return false|mysqli
 */
function connection()
{
	$dsn = "127.0.0.1";
	$pass = '';
	$conn = new mysqli($dsn, 'root', $pass, 'iobit');
	if (!$conn->error) {
		return $conn;
	} else {
		return false;
	}
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
 * 加密解密(false:加密,true:解密)
 * @param string $string
 * @param string $key
 * @param bool $operation
 * @param int $expiry
 * @return string
 */
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

/**
 * 获取字符串重组数组,以字符为key,每个字符出现次数为value
 * @param $str
 * @return array
 */
function str_count_array($str): array
{
	$str_array = str_split($str);
	$str_array = array_count_values($str_array);
	arsort($str_array);
	return $str_array;
}

/**
 * 判断两字符串同分异构
 * @param $handle <p>被匹配字符</p>
 * @param $needle <p>匹配字符</p>
 * @return bool
 */
function Same($handle, $needle): bool
{
	if (strlen($handle) == strlen($needle)) {
		$handle_array = str_count_array($handle);
		$needle_array = str_count_array($needle);
		if (empty(array_diff_assoc($handle_array, $needle_array))) {
//			if (empty(array_diff_assoc($needle_array, $handle_array))) {
				return true;
//			}
		}
	}
	return false;
}
var_dump(str_count_array('qweqwewerweter'));