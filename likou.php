<?php
error_reporting(0);

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
function encrypt($data, $key)
{
    $key    =   md5($key);
    $x      =   0;
    $len    =   strlen($data);
    $l      =   strlen($key);
    for ($i = 0; $i < $len; $i++)
    {
        if ($x == $l)
        {
            $x = 0;
        }
        $char .= $key{$x};
        $x++;
    }
    for ($i = 0; $i < $len; $i++)
    {
        $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
    }
    return base64_encode($str);
}

function decrypt($data, $key)
{
    $key = md5($key);
    $x = 0;
    $data = base64_decode($data);
    $len = strlen($data);
    $l = strlen($key);
    for ($i = 0; $i < $len; $i++)
    {
        if ($x == $l)
        {
            $x = 0;
        }
        $char .= substr($key, $x, 1);
        $x++;
    }
    for ($i = 0; $i < $len; $i++)
    {
        if (ord(substr($data, $i, 1)) < ord(substr($char, $i, 1)))
        {
            $str .= chr((ord(substr($data, $i, 1)) + 256) - ord(substr($char, $i, 1)));
        }
        else
        {
            $str .= chr(ord(substr($data, $i, 1)) - ord(substr($char, $i, 1)));
        }
    }
    return $str;
}
//$key = getCode(8);
//var_dump(encrypt("['status' => 500, 'data' => '', 'massage' => 'Request data error']", '$key'));
//var_dump(decrypt(encrypt("['status' => 500, 'data' => '', 'massage' => 'Request data error']", '$key'), '$key'));
echo time();
//exit();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
        $.ajax({
            type: 'POST',
            url: 'index.php',
            success: function (res) {
                console.log(res)
                data = new Date();
                console.log(Math.floor(data.getTime()/1000));
            }
        })
</script>

<?php

$method = '';
echo $method == 'timeline' ? '3' : '2';