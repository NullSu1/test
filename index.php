<!--<form method="post" enctype="multipart/form-data">-->
<!--    <input type="file" name="file">-->
<!--    <input type="submit" name="sub">-->
<!--</form>-->
<?php
//if(!is_dir('images/new')){
//
//    mkdir('images/new');
//}
//
//if(isset($_POST['sub']))
////    var_dump($_FILES);
//    move_uploaded_file($_FILES['file']['tmp_name'], 'images/new/'.basename($_FILES['file']['name']));

if(!empty($_GET['ref'])){

    $ref = strtolower($_GET['ref']);
    $re = strstr($ref,'ir');

    if($re !== false){

//        var_dump($re = strstr($ref,'ir'));
        var_dump($re);
        var_dump($ref);

//        $ref = substr()

//        preg_match_all('/([0-9]*)\./', $ref);
    }
}