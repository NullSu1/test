<?php
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
 * @param $end
 * @param $start
 * @return string
 */
function 时间差($end, $start)
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

var_dump( 时间差(strtotime('2021-02-03 23:59:59'),time()));


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
function getIP()
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
function mail_check($email)
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
 * 获取字符串重组数组
 * @param $str
 * @return array
 */
function countStr($str): array
{
	$str_array = str_split($str);
	$str_array = array_count_values($str_array);
	arsort($str_array);
	return $str_array;
}

/**
 * 判断两字符串同分异构
 * @param $handle *被匹配字符
 * @param $needle *匹配字符
 * @return bool
 */
function Same($handle, $needle): bool
{
	if (strlen($handle) == strlen($needle)) {
		$handle_array = countStr($handle);
		$needle_array = countStr($needle);
		if (empty(array_diff_assoc($handle_array, $needle_array))) {
			if (empty(array_diff_assoc($needle_array, $handle_array))) {
				return true;
			}
		}
	}
	return false;
}

echo Same($_GET['a'],'qwerty') ? '123':'kkk';
