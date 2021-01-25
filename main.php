<?php
function str_check($str)
{
    $str = addslashes($str);
    $str = htmlspecialchars($str);
    $str = str_replace(' ', '~~', trim($str));
    return $str;
}

function connection()
{
//    $dsn = 'ld-iobit-com.cylexcs6bned.us-east-1.rds.amazonaws.com';
    $dsn = '127.0.0.1';
    $pass = '';
//    $pass = 'yzfu9CFYcdo8LyyCg7Kd';
    $conn = new mysqli($dsn, 'root', $pass, 'test');
    if (!$conn->error) {
        return $conn;
    } else {
        return false;
    }
}

function select_query($sql)
{
    $num = 0;
    $list = [];
    $result = connection()->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $list[$num] = $row;
            $num++;
        }
    }
    return $list;
}

echo str_check('ASDASD');

$letter = "SELECT sender, receiver, letter FROM `letter` WHERE fb_id='2803969269842527' ORDER BY date DESC limit 0,1";
$arr_letter = select_query($letter)[0];

var_dump($arr_letter);