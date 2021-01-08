<?php
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

var_dump( 时间差(strtotime('2020-12-31 23:59:59'),time()));

function send_email($type)
{
    return $type;
}

function one()
{
    $click = rand(1, 100);
    if ($click <= 35) {
        $sql = "insert into table_name (awarded_one) values ('db') ";
        return "db";
    } elseif ($click <= 70) {
        $sql = "insert into table_name (awarded_one) values ('iu') ";
        return "iu";
    } else {
        return null;
    }
}


function str_check($str)
{
    $str = addslashes($str);
    $str = htmlspecialchars($str, ENT_QUOTES);
    $str = str_replace(' ', '-', trim($str));
    return $str;
}
var_dump(str_check('iu'));

//$str = str_check($a[1]);
$conn = new mysqli('127.0.0.1', 'root', '', 'iobit');
//$sql = "insert into info (name) values ('$str')";
//$result = $conn->query($sql);
//if(!$result){
//    echo $conn->error;
//}

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

function mail_check($email)
{
    if (!preg_match("^[_\.0-9a-z+-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3}$^", $email)) {
        return false;
    }
    return $email;
}

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

//$conn = connection();
//$click = rand(1, 100);
//$name = str_check('name');
//$email = mail_check("the.nullsu@gmail.com");
//$ip = '1';
//$onlya_result = '20';
//$date = date('Y-m-d H:i:s');
//$day = date("d");
//var_dump(date("H"));
//$sql = "select COUNT(*) from info where date='2020-11-11' and awarded_two!='$onlya_result'";
//$select = $conn->query($sql)->fetch_assoc()['COUNT(*)'];
//if (date("H") == '21') {
//    if ($select == 0) {
//        echo $select;
//    } else {
//        echo $select;
//    }
//}

echo date('Y-m-d',strtotime("-6964 day"))."<br>";
$days = 6964;
$year = intval($days / 365.5);
$m = intval(($days % 365.5) / 30);
$day = ($days % 365.5) % 30;
echo $year.'年'.$m.'月'.$day.'天';
//var_dump($days % 365.5);