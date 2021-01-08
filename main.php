<?php
function connection()
{
//    $dsn = 'ld-iobit-com.cylexcs6bned.us-east-1.rds.amazonaws.com';
    $dsn = '127.0.0.1';
    $pass = '';
//    $pass = 'yzfu9CFYcdo8LyyCg7Kd';
    $conn = new mysqli($dsn, 'root', $pass, 'iobit');
    if (!$conn->error) {
        return $conn;
    } else {
        return false;
    }
}
//echo $le = str_check("str_check(my letter)");
$conn = connection();
$sql = "select name from info";
$result = $conn->query($sql);
$list = [];
$num = 0;
if($result){
    if($result->num_rows > 0){
        while ($row = $result->fetch_array()){
            $list[$num] = $row['name'];
            $num++;
        }
    }
}
echo json_encode($list);
exit();
