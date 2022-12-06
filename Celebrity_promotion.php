<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
error_reporting(0);
strpos('','');
define('ADMIN_USERNAME', 'admin');     // Admin Username
define('ADMIN_PASSWORD', 'x7HRwgLOTbZl');      // Admin Password

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != ADMIN_USERNAME || $_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD) {
    Header("WWW-Authenticate: Basic realm=''");
    Header("HTTP/1.0 401 Unauthorized");
    exit('Unauthorized');
}


$conn = new mysqli('127.0.0.1', 'root', 'SW8jimOWbwVP@', 'promotion');
//$conn = new mysqli('127.0.0.1', 'root', '', 'promotion');
$sql = "SELECT * FROM `promotion` where 1";
if($id = $_GET['promotion_field']){
    $item = $sql." and promotion_field='$id'";
    $result = [];
    $check = $conn->query($item);
    if($check->num_rows > 0){
        $result = $check->fetch_assoc();
    }
}
if(!empty($_GET['delete'])){
    $delefield = $_GET['delete'];
    $delesql = "DELETE FROM `promotion` WHERE `promotion_field`='$delefield'";
    if($conn->query($delesql))
        exit('true');
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>Action Center 推荐后台管理</title>
    <style>
        a {
            color: black;
            text-decoration: black;
        }

        .tdcenter {
            text-align: center;
            width: 400px;
        }

        fieldset {
            width: auto;
            height: auto;
            border: 3px solid #ccc;
        }
        textarea {
            width: 350px;
            height: 80px;
            border: none;
            row-span: 5;
        }
    </style>
</head>
<body>
<div class="inline left">
    <strong>
        <span>红人推广推荐后台管理</span>
    </strong>
</div>
<br>
<div>
    <center>
        <table >
            <form method="post" enctype="multipart/form-data">
                <tr>
                    <td align="right">需求编号:</td>
                    <td><input type="text" name="id" size="100" required="required"
                               value="<?= $_GET['promotion_field'] ? $result['promotion_id'] : ''; ?>"></td>
                    <td>*必填信息</td>
                </tr>
                <tr>
                    <td align="right">推广渠道专属字段:</td>
                    <td><input type="text" name="name" size="100" required="required"
                               value="<?= $_GET['promotion_field'] ? $result['promotion_field'] : ''; ?>"></td>
                    <td>*必填信息</td>
                </tr>
                <tr>
                    <td align="right">原始加UTM参数 URL:</td>
                    <td><input type="text" name="link" size="100" required="required"
                               value="<?= $_GET['promotion_field'] ? $result['promotion_url'] : ''; ?>"></td>
                    <td>*必填信息</td>
                </tr>
                <tr>
                    <td align="right">需求人:</td>
                    <td><input type="text" name="require" size="100" required="required"
                               value="<?= $_GET['promotion_field'] ? $result['requester'] : ''; ?>"></td>
                    <td>*必填信息</td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td>
                        <input type="submit" name="subm" value="提交&更新"
                               style="border-radius:9px;width: 100px;height: 40px">
                        <?php if (!empty($_GET['promotion_field'])) : ?>
                            <button style="border-radius:9px;width: 100px;height: 40px">
                                <a href="Celebrity_promotion.php">清空</a>
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>

            </form>
        </table>
</div>
<?php
if(isset($_POST['subm'])){
    $promotion_id = addslashes($_POST['id']);
    $promotion_field = addslashes($_POST['name']);
    $promotion_url = addslashes($_POST['link']);
    $requester = addslashes($_POST['require']);
    $date = date('Y-m-d H:i:s');
    if($_GET['promotion_field']){
        $subsql = "UPDATE `promotion` SET `promotion_id`='". $promotion_id ."',`promotion_field`='". $promotion_field ."',`promotion_url`='". $promotion_url ."',
        `requester`='". $requester ."',`update_at`='". $date ."' WHERE `promotion_field`='$promotion_field'";
    }else{
        $subsql = "INSERT INTO `promotion`(`promotion_id`, `promotion_field`, `promotion_url`, `requester`, `create_at`, `update_at`) 
                VALUES ('$promotion_id','$promotion_field','$promotion_url','$requester','$date','$date')";
    }
    if($conn->query($subsql)){
        $queryStr = empty($_SERVER['QUERY_STRING'])?'':('?'.$_SERVER['QUERY_STRING']);
        echo "<script>
alert('successfully')
window.location.href='Celebrity_promotion.php" .$queryStr. "';
</script>";

//        header("location: ".$queryStr);
    }else{
        echo "<script>alert('推广渠道专属字段重复')</script>";
    }
}
?>
<div>
    <p>
        <strong>现有列表</strong>
    </p>
    <form method="get">
        <input name="search" type="text" value="<?= $_GET['search']; ?>" placeholder="推广渠道专属字段">
        <input name="promotion_field" type="hidden" value="<?= $_GET['promotion_field']; ?>" >
        <input name="page" type="hidden" value="<?= $_GET['page']; ?>" >
        <input type="submit" value="search" style="border-radius:9px;width: 80px;height: 20px">
    </form>
</div>
<div>
    <fieldset>
        <center>
            <div>
                <table border="1">
                    <tr>
                        <td class="tdcenter"></td>
                        <td class="tdcenter">需求编号</td>
                        <td class="tdcenter">推广渠道专属字段</td>
                        <td class="tdcenter">目标链接</td>
                        <td class="tdcenter">原始加UTM参数 URL</td>
                        <td class="tdcenter">需求人</td>
                        <td class="tdcenter">create</td>
                        <td class="tdcenter">update</td>
                    </tr>
                    <?php
                    $search = empty($_GET['search']) ? '' : ' AND `promotion_field` like "%'.addslashes($_GET['search']).'%"';

                    $searchsql = $sql.$search;

                    $pageSize = 20;
                    $page = (!empty($_GET['page']) && $_GET['page'] >= 0) ? ($_GET['page']-1) : 0;

                    $start = ($page)*$pageSize;
                    $limit = ' limit '.$start.','.$pageSize;
                    $result = $conn->query($searchsql.$limit);

                    $allpage = ceil($conn->query($searchsql)->num_rows / $pageSize);
                    if($result->num_rows > 0)
                        while ($detail = $result->fetch_assoc()) :?>
                            <tr>
                                <?php $url = 'https://www.karativa.com/'.strtolower(str_replace(' ','',$detail['promotion_field']));?>
                                <td class="tdcenter">
                                    <button><?= "<a href='?promotion_field=". $detail['promotion_field'] ."&search=". $_GET['search'] ."&page=" . ($page + 1) . "'>"; ?>修改</a></button>
                                    <button hidden onclick="isDele('<?= $detail['promotion_field']; ?>')">删除</button>
                                </td>
                                <td class="tdcenter"><?= $detail['promotion_id'] ?></td>
                                <td class="tdcenter"><?= $detail['promotion_field'] ?></td>
                                <td class="tdcenter"><a target="_blank" href="<?= $url?>"><?= $url?></td>
                                <td class="tdcenter">
                                    <textarea disabled><?= $detail['promotion_url'] ?></textarea>
                                </td>
                                <td class="tdcenter"><?= $detail['requester'] ?></td>
                                <td class="tdcenter"><?= $detail['create_at'] ?></td>
                                <td class="tdcenter"><?= $detail['update_at'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                </table>
                <div>
                    <?= $page > 0 ? '<a href="?promotion_field='. $_GET['promotion_field'] .'&search='. $_GET['search'] .'&page='. $page .'">上一页</a>' : '';?>
                    <span>第<?= $page+1; ?>页</span>/<span>共<?= $allpage?>页</span>
                    <?= ($page+1 < $allpage)? '<a href="?promotion_field='. $_GET['promotion_field'] .'&search='. $_GET['search'] .'&page='. ($page+2) .'">下一页</a>' : '';?>
                </div>
            </div>
    </fieldset>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    function isDele(id) {
        if (confirm('确认删除已选择数据吗?')) {
            $.ajax({
                type: "GET",
                url: "Celebrity_promotion.php",
                data: "delete="+id,
                success: function (res) {
                    console.log(res);
                    if(res == 'true') {
                        alert('已删除')
                        location.reload();
                    }
                }
            })
        }
    }
</script>
</html>


