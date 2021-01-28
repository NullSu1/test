<?php

use boot\ablum;
use boot\singin;

require_once "singin.php";
require_once "ablum.php";
require_once "pic.php";
$header = <<<EOF
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>Checkout example for Bootstrap</title>
<!-- Bootstrap 核心CSS -->
<link rel="stylesheet" href="https://code.z01.com/v4/dist/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="style/home.css">-->
<!--<link rel="stylesheet" href="https://code.z01.com/boot/dist/css/font-awesome.min.css">-->
<!-- Favicons图标定义 -->
<link rel="apple-touch-icon" href="https://code.z01.com/v4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="https://code.z01.com/v4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="https://code.z01.com/v4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="mask-icon" href="https://code.z01.com/v4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<meta name="msapplication-config" content="https://code.z01.com/v4/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">
<!-- Meta关键字定义 -->
<meta name="description" content="The most popular HTML, CSS, and JS library in the world.">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<style>
:root {--jumbotron-padding-y: 3rem;}
.jumbotron {padding-top: var(--jumbotron-padding-y);padding-bottom: var(--jumbotron-padding-y);margin-bottom: 0;background-color: #fff;}
@media (min-width: 768px) {
  .jumbotron {padding-top: calc(var(--jumbotron-padding-y) * 2);padding-bottom: calc(var(--jumbotron-padding-y) * 2);}
}
.jumbotron p:last-child {margin-bottom: 0;}
.jumbotron-heading {font-weight: 300;}
.jumbotron .container { max-width: 40rem;}
footer {padding-top: 3rem;padding-bottom: 3rem;}
footer p {margin-bottom: .25rem;}
.box-shadow { box-shadow: 0 .25rem .75rem rgba(0, 0, 0, .05); }
</style>
EOF;

$footer = <<<EOF
<footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <img class="mb-2" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="24" height="19">
                <small class="d-block mb-3 text-muted">© 2017-2020</small>
            </div>
            <div class="col-6 col-md">
                <h5>Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary" href="#">Cool stuff</a></li>
                    <li><a class="link-secondary" href="#">Random feature</a></li>
                    <li><a class="link-secondary" href="#">Team feature</a></li>
                    <li><a class="link-secondary" href="#">Stuff for developers</a></li>
                    <li><a class="link-secondary" href="#">Another one</a></li>
                    <li><a class="link-secondary" href="#">Last time</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>Resources</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary" href="#">Resource</a></li>
                    <li><a class="link-secondary" href="#">Resource name</a></li>
                    <li><a class="link-secondary" href="#">Another resource</a></li>
                    <li><a class="link-secondary" href="#">Final resource</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="link-secondary" href="#">Team</a></li>
                    <li><a class="link-secondary" href="#">Locations</a></li>
                    <li><a class="link-secondary" href="#">Privacy</a></li>
                    <li><a class="link-secondary" href="#">Terms</a></li>
                </ul>
            </div>
        </div>
    </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
EOF;

function checkLog()
{
    if (empty($_COOKIE['log']) || $_COOKIE['log'] == '') {
        return false;
    } else {
        return true;
    }
}

if (isset($_REQUEST['sub'])) {
    $sign = new singin($_REQUEST['inputPassword'],$_REQUEST['inputEmail']);
    if ($sign->checkUser()) {
        if ($sign->checkPass()) {
            setcookie('log',$_REQUEST['inputEmail'],time()+3600);
        } else echo "<script>alert('用户名或密码错误');window.location.href='signin.php'</script>";
    } else echo "<script>alert('用户名或密码错误');window.location.href='signin.php'</script>";
}

if (isset($_POST['create'])) {
    $ablum = new ablum;
    $ablum->Ablum('create', $_COOKIE['log'], $_POST['ablum'], $_POST['comment']);
}