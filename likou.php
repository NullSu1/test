<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    $.ajax({
        url: 'main.php',
        success: function (data) {
            data = JSON.parse(data);
            var description = "";
            for (var i in data) {
                description += "<li>" + data[i] + "\n";
            }
            console.log(description);
        }
    })
</script>
<?php
function str_check($str)
{
    $str = addslashes($str);
    $str = htmlspecialchars($str, ENT_QUOTES);
    $str = str_replace(' ', '-', trim($str));
    return $str;
}
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
$name = 'name';
$sql = "select $name from info";
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
var_dump($list);
exit();
?>


