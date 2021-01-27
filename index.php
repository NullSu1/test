<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta property="og:url" content="https://ld.iobit.com/newsletter/2020hibella/index.html?r"/>
    <meta property="fb:app_id" content="1137470886655086"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Rate My PC - Smart Game Booster"/>
    <meta property="og:description" content="My PC is rated 30% by SmartGameBooster. Get yours and compare to me "/>
    <meta property="og:image" content="https://ld.iobit.com/2020/asc/giveawaytg2020/static/img/amazon.png?961"/>
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=0,minimal-ui,viewport-fit=cover">
    <title>Document</title>
    <link rel="stylesheet" href="style/font.css" media="all">
    <link rel="stylesheet" href="style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <script src="https://codes.iobit.com/js/jquery/jquery-1.7.1.min.js" type="text/javascript"></script>
</head>
<body>
<div class="main reveal-box">
    <!-- <div class="default ">
        <h2>Join to Win</h2>
        <P>Hibella Glammirror</P>
        <div class="mirror">
           <div class="message">
            <p>Love is beautiful, <br> let's speak it out!</p>
            <p class="name">- Hibella</p>
           </div>
        </div>
        <a href="<?= $loginUrl; ?>" class="go btn">GO~</a>
    </div> -->
    <div class="rulesbox ">
        <h2>How to win?</h2>
        <p><span>1.</span> Creat your love letter</p>
        <p><span>2.</span> Share it to FB friends</p>
        <p><span>3.</span> FB friends reply you with hearts</p>
        <p><span>4.</span> Follow SNS and visit website can help you get more hearts</p>
        <p><span>5.</span> The top three with most heats will get Hibella mirror free</p>
        <p><span>6.</span> The top 20 can exchange hearts to Hibella coupon</p>
        <span class="start btn">Start My Love Letter</span>
    </div>
    <div class="submit hide">
        <p>
            <label>The name of sender:</label>
            <input type="text" id="sender">
        </p>
        <p>
            <label>The name of recipients:</label>
            <input type="text" id="recipients">
        </p>
        <p>
            <label>Write your words:</label>
            <input type="text" id="words">
        </p>
        <p>Or choose a love letter template</p>
        <div class="content">
            <ul id="pageone">
                <li data-num="0" class="first"><p>Having you in my life makes each day a little brighter.</p></li>
                <li data-num="1" class="active"><p>I realize today, no one has ever really touched me before you.</p></li>
                <li data-num="2" class="two"><p>You are the yummiest person in my life.</p></li>
                <li data-num="3"><p>You are my fantasy come true! You were made for me.</p></li>
                <li data-num="4"><p>You are one of the best things that ever happened to me.</p></li>
            </ul>
            <div class="box">
                <span></span>
                <span class="active"></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <span class="letter btn">Generate Love Letter</span>
    </div>
    <div class="share hide">
        <div class="mirror">
            <div class="message">
                <p class="name first">Dear <span id="recipients"></span>:</p>
                <p id="letter">Having you in my <br> life makes each day a <br> little brighter.</p>
                <p class="name">- Hibella</p>
            </div>

        </div>
        <span class="btn-share btn">Go to share</span>
    </div>
    <div class="reveal hide">
        <div class="rules">
        <span class="rules-btn">
          Rules
        </span>
            <span class="edit btn">Edit and Share</span>
        </div>
        <div class="mirror-box">
            <div class="mirror">
                <p class="first">Dear Sunpoet:</p>
                <p class="information"> Having you in my life makes each day a little brighter.</p>
                <p>- From Chloe</p>
            </div>
            <div class="message">
                <dl>
                    <dt>Receipients：</dt>
                    <dd><img src="images/list01.svg"> 28</dd>
                    <dt>Hearts：</dt>
                    <dd><img src="images/list02.svg"> 28</dd>
                    <dt>RanKing：</dt>
                    <dd><img src="images/list03.svg"> 28</dd>
                </dl>
            </div>
        </div>
        <div class="btn-get">
            <a class="btn pressed" target="_blank" href="#">
                <b>Follow FB get</b>
                <i></i><i></i>
            </a>
            <a class="btn" target="_blank" href="#">
                <b>Visit website get</b>
                <i></i><i></i>
            </a>
            <a class="btn" target="_blank" href="#">
                <b>Follow Ins get</b>
                <i></i><i></i>
            </a>
            <a class="btn" id="timeline">
                <b>Share to timeline get</b>
                <i></i><i></i><i></i>
            </a>
        </div>
        <ul class="list">
            <li>XXX Send you a heart</li>
            <li>XXX Send you a heart</li>
            <li>XXX Send you a heart</li>
            <li>XXX Send you a heart</li>
            <li>XXX Send you a heart</li>
            <li>XXX Send you a heart</li>
        </ul>
    </div>

    <div class="congratulations hide">
        <img src="images/win-title.svg" alt="">
        <div class="mirror"></div>
        <h3>You ranked <strong>1st</strong> in #Hibellaloveletter <br> You can get</h3>
        <div class="first-place hide">
            <div class="ranking">
                One Hibella Glamirror Free
            </div>
            <p>
                Please email us at <a href="mailto:social@hibella.com">social@hibella.com</a> screenshot of this page to
                accept your award. Thanks for your participation.
            </p>
        </div>
        <div class="twenty-place">
            <div class="coupon">
                <strong>$5 Coupon</strong>
                valid until 2020.11.20
            </div>
            <a href="#" class="btn">Go to use</a>
        </div>
        <p class="last">
            Check Ranking
        </p>
        <p class="shared">Love is shared by each other to answer someone's dream.</p>
    </div>
    <div class="popbg hide"></div>
    <div class="poprules hide">
        <i class="close"></i>
        <h3>Rules</h3>
        <p><span>1.</span>The top three with most heats will get Hibella mirror free</p>
        <p><span>2.</span>The top 20 can exchange hearts into coupon,10 hearts=$5 coupon</p>
        <p><span>3.</span>All other participants can get $5 coupon</p>
        <p><span>4.</span>This event ends on XXX</p>
        <p><span>5.</span>The winners will be publoshed on XXX</p>
        <p><span>6.</span>Prize will be shipped onXXX</p>
        <p><span>7.</span>All coupons are valid untill XXX</p>
    </div>
    <div class="popranking hide">
        <i class="close"></i>
        <h3>Hibella ranking</h3>
        <p>
            <span>1 . Abbie</span>
            <span><i></i> 99</span>
        </p>
        <p>
            <span>2 . Abbie</span>
            <span><i></i> 99</span>
        </p>
        <p>
            <span>3 . Abbie</span>
            <span><i></i> 99</span>
        </p>
        <p>
            <span>4 . Abbie</span>
            <span><i></i> 99</span>
        </p>
        <p>
            <span>5 . Abbie</span>
            <span><i></i> 99</span>
        </p>
        <p>
            <span>6 . Abbie</span>
            <span><i></i> 99</span>
        </p>
        <p>
            <span>.....</span>

        </p>
    </div>
</div>
</body>
<script>
    var w = window.screen.height;
    var numbox;
    $(".main").css('height', w - 80)
    $(".main .default .go").click(function () {
        $(".main .default ").remove();
        $(".main .rulesbox").removeClass("hide");
    })
    $(".main .rulesbox .start").click(function () {
        $(".main .rulesbox").remove();
        $(".main .submit").removeClass("hide");
        $(".main").addClass("submit-box");
    })
    $("body").on("click",".main .submit .content .first,.main .submit .content .two", function(event) {
        var num =$(this).index();
        var lenght = $(".main .submit .content li").length;
        $(".main .submit .content li").removeClass("first").removeClass("active").removeClass("two")

        if(num==0){
            $(".main .submit .content li").eq(lenght-1).addClass("first")
            $(".main .submit .content li").eq(num).addClass("active")
            $(".main .submit .content li").eq(num+1).addClass("two")
        }
        else {
            $(".main .submit .content li").eq(num-1).addClass("first")
            $(".main .submit .content li").eq(num).addClass("active")
            $(".main .submit .content li").eq(num+1).addClass("two")
            if(num==4) {
                $(".main .submit .content li").eq("0").addClass("two")
            }
        }
        numbox = $(".main .submit .content li.active").attr("data-num")
        $(".main .submit .content .box span").eq(numbox).addClass("active").siblings().removeClass("active")
    })

    function change(num) {

        var lenght = $(".main .submit .content li").length;
        $(".main .submit .content li").removeClass("first").removeClass("active").removeClass("two")

        if(num==0){
            $(".main .submit .content li").eq(lenght-1).addClass("first")
            $(".main .submit .content li").eq(num).addClass("active")
            $(".main .submit .content li").eq(num+1).addClass("two")
        }
        else {
            $(".main .submit .content li").eq(num-1).addClass("first")
            $(".main .submit .content li").eq(num).addClass("active")
            $(".main .submit .content li").eq(num+1).addClass("two")
            if(num==4) {
                $(".main .submit .content li").eq("0").addClass("two")
            }
        }
        numbox = $(".main .submit .content li.active").attr("data-num")
        $(".main .submit .content .box span").eq(numbox).addClass("active").siblings().removeClass("active")
    }


    $(".main .submit .letter").click(function () {
        $(".main").removeClass("submit-box");
        $(".main .submit ").addClass("hide");
        $(".main .share").removeClass("hide");
    })
    $(".main .reveal .rules-btn").click(function () {
        $(".popbg,.poprules").removeClass("hide");
    })
    $(".main .congratulations .last").click(function () {
        $(".popbg,.popranking").removeClass("hide");
    })
    $(".poprules .close").click(function () {
        $(".popbg,.poprules").addClass("hide");
    })
    $(".congratulations .close").click(function () {
        $(".popbg,.congratulations").addClass("hide");
    })
    $(".popranking .close").click(function () {
        $(".popbg,.popranking").addClass("hide");
    })
    function reveal() {
        $(".default,.rulesbox,.submitm,.share").addClass("hide")
        $(".reveal").removeClass("hide")
        $(".main").addClass("reveal-box")
    }
    function congratulations() {
        $("body").addClass("congra")
        $(".default,.rulesbox,.submitm,.share,.reveal").addClass("hide")
        $(".congratulations").removeClass("hide")
    }

</script>
<script>
    $("#pageone").on("touchstart", function(e) {
        startX = e.originalEvent.changedTouches[0].pageX,
            startY = e.originalEvent.changedTouches[0].pageY;
    });
    $("#pageone").on("touchend", function(e) {
        moveEndX = e.originalEvent.changedTouches[0].pageX,
            moveEndY = e.originalEvent.changedTouches[0].pageY,
            X = moveEndX - startX,
            Y = moveEndY - startY;
        if ( X > 50 ) {
            var num = $(".main .submit .content li.first").index();
            change(num)
        }
        else if ( X < -50 ) {
            var num = $(".main .submit .content li.two").index();
            change(num)
        }
    });
</script>
<script>
    function statusChangeCallback(response) {
        if (response.status === 'connected') {
            console.log(response.authResponse.userID);
            shareAPI(response.authResponse.userID);
        } else {
            // alert('Please log into this webpage');
        }
    }

    function checkLoginState() {
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    }

    window.fbAsyncInit = function () {
        FB.init({
            appId: '1137470886655086',
            cookie: true,
            xfbml: true,
            version: 'v8.0'
        });

        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    };

    function shareAPI(id) {
        FB.api('/me?felids=', function (response) {
            var name = response.name;
            $(".main .submit .letter").click(function () {
                var sender = $(".main .submit #sender").val();
                var words = $(".main .submit #words").val();
                if (words == '') {
                    words = $(".main .submit .content .active").text();
                }
                recipients = $(".main .submit #recipients").val();
                $.ajax({
                    url: "./functions.php",
                    type: "POST",
                    data: {'send_id': id, 'sender': sender, 'recipients': recipients, 'letter': words},
                    success: function(res){
                        console.log(id)
                        console.log(sender)
                        console.log(recipients)
                        console.log(words)
                    }
                })
                $(".main .share .mirror #recipients").html(recipients);
                $(".main .share .mirror #letter").html(words);
            });
            $(".main .share .btn-share").click(function () {
                var sender = $(".main .submit #sender").val();
                var words = $(".main .submit #words").val();
                if (words == '') {
                    words = $(".main .submit .content .active").text();
                }
                recipients = $(".main .submit #recipients").val();
                FB.ui({
                    display: 'popup',
                    method: 'share',
                    href: 'https://ld.iobit.com/newsletter/2020hibella/send.html?shareid='+id+'&sender='+sender+'&receiver='+recipients+'&words='+words,
                }, function (response) {
                    if (response != undefined) {
                        $.ajax({
                            url: './functions.php',
                            type: 'post',
                            data: {"share": id, 'id': id, 'name': name},
                            success: function () {
                                console.log(123);
                            }
                        });
                        alert('YES');
                    } else {
                        alert('Error while posting.');
                    }
                });
            });
            $("#timeline").click(function(){
                var sender = $(".main .submit #sender").val();
                var words = $(".main .submit #words").val();
                if (words == '') {
                    words = $(".main .submit .content .active").text();
                }
                recipients = $(".main .submit #recipients").val();
                FB.ui({
                    display: 'popup',
                    method: 'feed',
                    link: 'https://ld.iobit.com/newsletter/2020hibella/send.html?shareid='+id+'&sender='+sender+'&receiver='+recipients+'&words='+words,
                }, function (response) {
                    if (response != undefined ) {
                        $.ajax({
                            url: './functions.php',
                            type: 'post',
                            data: {"share": id, 'id': id, 'name': name}
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