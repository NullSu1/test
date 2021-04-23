<?php
//ini_set("display_errors",-1);
//error_reporting(-1);
error_reporting(0);
//mysqli_report(MYSQLI_REPORT_ALL);
session_start();

require_once "main/db.php";
require_once "main/db_config.php";
require_once "main/getList.php";
require_once "main/functions.php";
include_once "main/MysqlQuery.php";

$page = empty($_GET['page']) ? 1 : $_GET['page'];

$MysqlQuery = new MysqlQuery($db_book);

$classlists = $MysqlQuery->getLists('class', '', 'td_demo02');

$date = date('Y-m-d H:i:s');

include_once "site/header.php";

if (!checkLog()) $_GET['action'] = 'login';

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

        if(empty($_GET['id'])) echo "<script>alert('error!');window.location.href='index.php'</script>";

        $id = addslashes($_GET['id']);

        $result = $MysqlQuery->selectQuery("SELECT * FROM `td_demo02` WHERE 1 and `td_demo02`.`id`='$id'")[0];

        include_once "site/transaction.php";

        break;

    case 'login':

        include_once "site/login.php";

        if(isset($_POST['sub'])){

            $name = addslashes($_POST['one']);

            $passwd = addslashes($_POST['pwd']);

            $sql = "SELECT `passwd`,`balance` FROM `user` WHERE 1 and `user`.`user`='$name'";

            $re = $MysqlQuery->Conn()->query($sql)->fetch_assoc();

            if(empty($re['passwd'])) exit('false');

            $needle = authcode($re['passwd'],'',true);

            if($passwd == $needle) {

                $_SESSION["user"] = $name;

                $_SESSION["balance"] = $re['balance'];

                echo "<script>alert('".$name."');window.location.href='index.php'</script>";
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
    case 'order':
        $id = addslashes($_POST['id']);

        $sqlstr = "SELECT `book_name`, `cover_art`, `pri`, `author` FROM `td_demo02` WHERE 1 and id='$id'";

        $result = $MysqlQuery->selectQuery($sqlstr)[0];

        $order = authcode($_SESSION['user'].$result['author']);

        include_once "site/order.php";

        break;

    default :

        include_once "site/view.php";
}
include_once "site/footer.php";

