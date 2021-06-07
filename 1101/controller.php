<?php
switch ($_GET['action']){
    case 'login':

        include_once "site/login.php";

        $_SESSION["user"] = '';

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

                $_SESSION['expiretime'] = time() + 3600;

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

    case 'update':

        include_once 'site/update.php';

        $uplode = "site/static/images/cover_pic".date("Y-m-d");

        if(isset($_POST['sub'])){

            if(!is_dir($uplode)) mkdir($uplode);

            var_dump($_FILES);

            if(!move_uploaded_file($_FILES['file']['tmp_name'], $uplode.'/'.basename($_FILES['file']['name'])))exit('文件上传出错');

            $cover_pic = $uplode.'/'.addslashes($_FILES['file']['name']);
            $name = addslashes($_POST['book_name']);
            $pir = addslashes($_POST['pri']);
            $class = addslashes($_POST['class']);
            $author = $_SESSION['user'];



            $sql = "INSERT INTO `td_demo02`(`book_name`, `cover_art`, `pri`, `out_time`, `class`, `author`) 
                    VALUES ('$name','$cover_pic','$pir','$date','$class', '$author')";

            $MysqlQuery->changeQuery($sql);
//            header("https/1.1 303");
//            header("location:./index.php?action=update");
        }

        break;

    case 'transaction':

        if(empty($_GET['id'])) echo "<script>alert('error!');window.location.href='index.php'</script>";

        $id = addslashes($_GET['id']);

        $result = $MysqlQuery->selectQuery("SELECT * FROM `td_demo02` WHERE 1 and `td_demo02`.`id`='$id'")[0];

        $_SESSION['book'] = $result;

        include_once "site/transaction.php";

        $user = addslashes($_SESSION['user']);

        $order = 'user:'.$user.'-author:'.$result['author'].'-book_id:'.$result['id'];

        $order = encrypt($order,'kkk');

        $time = time();

        $sql = "INSERT INTO `order`(`user`, `book_id`, `order`, `date`, `time`) VALUES ('$user','$id', '$order','$date','$time')";

        if(!$MysqlQuery->Conn()->query($sql)){

            exit("<script>alert('请勿重复下单');history.go(-1)</script>");
        }else
            echo "<script>window.location.href='?action=order&id=".$id."'</script>";

        break;

    case 'order':
        $user = addslashes($_SESSION['user']);

        $id = addslashes($_GET['id']);

        $book_info = "SELECT `order`.`order`, `td_demo02`.`book_name`, `td_demo02`.`cover_art`, `td_demo02`.`pri` FROM `order` left join `td_demo02` on `order`.`book_id`=`td_demo02`.`id` where `order`.`book_id`='$id'";

        $result = $MysqlQuery->selectQuery($book_info)[0];

        include_once "site/order.php";

        if(isset($_POST['sub'])){

            $sql = "UPDATE `order` SET `stats`='1' WHERE 1 AND `user`='$user' AND `book_id`='$id'";

            if($_SESSION["balance"] < $result['pri']){

                exit("<script>alert('余额不足');</script>");
            }

            $MysqlQuery->changeQuery($sql);

            $_SESSION['balance'] -= $result['pri'];
        }
        if(isset($_POST['cancel'])){

            $sql = "UPDATE `order` SET `stats`='-1' WHERE 1 AND `user`='$user' AND `book_id`='$id'";

            $MysqlQuery->changeQuery($sql);
        }

        break;

    case 'orderList':

        $user = $_SESSION['user'];

        include_once "site/orderList.php";

        break;

    case 'bookshelf':

        $user = $_SESSION['user'];

        $sql = "SELECT `td_demo02`.`*` FROM `td_demo02` where (`td_demo02`.`id` IN (SELECT `order`.`book_id` FROM `order` WHERE `order`.`user`='$user' AND `order`.`stats`=1) OR `td_demo02`.`author`='$user')";

        include_once "site/bookshelf.php";

        break;
    case 'profile':
        $_SESSION['user'];

        $sql = "SELECT `id`, `user`, `passwd`, `balance`, `date` FROM `user` WHERE `user`='".$_SESSION['user']."'";

        $re = $MysqlQuery->selectQuery($sql);

        $password = authcode($re[0]['passwd'],'',true);

        include_once "site/profile.php";

        break;

    default :

        include_once "site/view.php";
}