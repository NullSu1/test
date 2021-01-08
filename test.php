<?php
header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Facebook JavaScript Example 1</title>
    <meta charset="UTF-8">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<div id="status"><div id="photo"></div><span>user</span>|status:<span>Unkonw</span></div>
<fb:login-button scope="public_profile,email,instagram_basic,pages_read_engagement" data-auto-logout-link="true" onlogin="checkLoginState();"></fb:login-button>
<div id="shareBtn"><button>share</button></div>
<script>
    function statusChangeCallback(response) {
        $("#status span").eq(1).text(response.status);
        if (response.status === 'connected') {
            $("#photo").append('<img src="https://graph.facebook.com/'+response.authResponse.userID+'/picture"/>');
            $("#status span").eq(0).text(response.authResponse.userID);
            shareAPI(response.authResponse.userID);
        } else {
            alert ('Please log into this webpage');
        }
        // setTimeout("statusChangeCallback(response)",1000);
    }

    function checkLoginState() {
        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1137470886655086',
            cookie     : true,
            xfbml      : true,
            version    : 'v8.0'
        });
        FB.Event.subscribe('send_to_messenger', function(e) {
            // callback for events triggered by the plugin

        });
        // FB.login(function(response) {
        //     console.log(response);
        // },
        // {
        //     scope: 'user_likes',
        //     auth_type: 'rerequest'
        // });

        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    };

    function shareAPI(id) {
        // FB.api(
        //     "/105874214495036/videos",
        //     function (response) {
        //         if (response && !response.error) {
        //             var description = "";
        //             for (var i in response) {
        //                 description += i + " = " + response[i] + "\n";
        //             }
        //             console.log(description);
        //         }
        //         else{
        //             var description = "";
        //             for (var i in response.error) {
        //                 description += i + " = " + response.error[i] + "\n";
        //             }
        //             console.log(description);
        //         }
        //     });
        FB.api('/me?felids=', function (response) {
            var name = response.name;
            $("#shareBtn").click(function () {
                FB.ui({
                    display: 'popup',
                    method: 'share',
                    href: 'https://ld.iobit.com/newsletter/2020hibella/index.html',
                }, function (response) {
                    var description = "";
                    for (var i in response) {
                        description += i + " = " + response[i] + "\n";
                    }
                    console.log(description);
                    if (response != undefined) {
                        $.ajax({
                            url: 'test.php',
                            type: 'post',
                            data: {"share":id,id:id,name:name},
                        });
                        alert('YES');
                    } else {
                        alert('Error while posting.');
                    }
                });
            });
        })
    }


</script>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
</body>
</html>
<?php
 $id = $_POST['id'];
 $name = $_POST['name'];
 $share = $_POST['share'];
 if(!empty($share)){
     $conn = new mysqli('ld-iobit-com.cylexcs6bned.us-east-1.rds.amazonaws.com','admin','yzfu9CFYcdo8LyyCg7Kd','test');
     $heard = $conn->query("select heard from user where fb_id='$id'")->fetch_row()[0];
     $conn->query("update user set heard='$heard'+2 where fb_id='$id'");
     $conn->affected_rows;
 }
 if(!empty($id)){
     $conn = new mysqli('ld-iobit-com.cylexcs6bned.us-east-1.rds.amazonaws.com','admin','yzfu9CFYcdo8LyyCg7Kd','test');
     $detect_sql = "insert into user (fb_id, fb_name) values('$id', '$name')";

     if($conn->query($detect_sql)){
         $conn->query("update user set heard=3 where fb_id='$id'");
     }
     if(!empty($share)){
         $heard = $conn->query("select heard from user where fb_id='$id'")->fetch_row()[0];
         if($conn->query("update user set heard='$heard'+2 where fb_id='$id'"))
             echo 'add heard';
         else
             echo $conn->error;
     }
 }
?>

