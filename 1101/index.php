<?php
//ini_set("display_errors",-1);
//error_reporting(-1);
error_reporting(0);
//mysqli_report(MYSQLI_REPORT_ALL);

require_once "main/db.php";
require_once "main/db_config.php";
require_once "main/getList.php";
include_once "main/MysqlQuery.php";

$page = empty($_GET['page']) ? 1 : $_GET['page'];

$MysqlQuery = new MysqlQuery($db_book);

$classlists = $MysqlQuery->getLists('class', '', 'td_demo02');

$date = date('Y-m-d H:i:s');

include_once "site/header.php";

switch ($_GET['action']){

    case 'update':

        include_once 'site/update.php';

        $uplode = "site/static/images/cover_pic".date("Y-m-d");

        if(isset($_POST['sub'])){

            if(!is_dir($uplode)) mkdir($uplode);

            move_uploaded_file($_FILES['file']['tmp_name'], $uplode.'/'.basename($_FILES['file']['name']));

            $cover_pic = $uplode.'/'.addslashes($_FILES['file']['name']);
            $name = addslashes($_POST['book_name']);
            $pir = addslashes($_POST['pri']);
            $class = addslashes($_POST['class']);

            $sql = "INSERT INTO `td_demo02`(`book_name`, `cover_art`, `pri`, `out_time`, `class`) 
                    VALUES ('$name','$cover_pic','$pir','$date','$class')";

            $MysqlQuery->changeQuery($sql);
        }

        break;

    case 'transaction':

        include_once "site/transaction.php";

        break;

    case 'login':

        include_once "site/login.php";

        if(isset($_POST['sub'])){

            $name = addslashes($_POST['one']);

            $passwd = addslashes($_POST['pwd']);

            $sql = "SELECT `passwd` FROM `user` WHERE 1 and `user`.`user`='$name'";

            $re = $MysqlQuery->Conn()->query($sql)->fetch_assoc();

            if(empty($re['passwd'])) exit('false');

            $needle = authcode($re['passwd'],'',true);

            if($passwd == $needle) {

                echo "<script>alert('sing in!');window.location.href='index.php'</script>";
            }

        } else if (isset($_POST['up'])){

            $name = addslashes($_POST['one']);

            $passwd = addslashes($_POST['pwd']);

            $passwd = authcode($passwd);

            $sql = "INSERT INTO `user`(`user`, `passwd`, `date`) VALUES ('$name','$passwd','$date')";

            if($MysqlQuery->changeQuery($sql))

                echo "<script>alert('sing up')</script>";
        }

        break;

    default :

        include_once "site/view.php";
}
include_once "site/footer.php";

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

