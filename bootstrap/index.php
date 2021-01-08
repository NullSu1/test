<?php

use boot\ablum;

include_once "functions.php";

if (!empty($_POST['action'])) {
    unset($_SESSION);
}
?>
<head>
    <?= $header; ?>
<!--    <link rel="stylesheet" href="https://code.z01.com/v4/dist/css/bootstrap.min.css">-->
</head>
<!--<header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">-->
<!--    <p class="h5 my-0 me-md-auto fw-normal">Company name</p>-->
<!--    <nav class="my-2 my-md-0 me-md-3">-->
<!--        --><?php //if (checkLog()): ?>
<!--            <form method="post">-->
<!--                <button type="button" class="btn btn-outline-primary" data-toggle="modal"-->
<!--                        data-target="#exampleModalCenter">-->
<!--                    Create-->
<!--                </button>-->
<!--                <button type="submit" name="action" class="btn btn-outline-primary">LogOut-->
<!--                    <br><span class="logout">(--><?//= $_SESSION['log']['user']; ?><!--)</span>-->
<!--                </button>-->
<!--            </form>-->
<!--            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"-->
<!--                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">-->
<!--                <div class="modal-dialog modal-dialog-centered" role="document">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="modal-header">-->
<!--                            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>-->
<!--                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                                <span aria-hidden="true">&times;</span>-->
<!--                            </button>-->
<!--                        </div>-->
<!--                        <div class="modal-body">-->
<!--                            <form method="post" action="index.php">-->
<!--                                <input type="hidden" value="--><?//= $_SESSION['log']['user']; ?><!--" name="user">-->
<!--                                <div class="modal-body">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="recipient-name"-->
<!--                                               class="col-form-label">Album-->
<!--                                            name:</label>-->
<!--                                        <input type="text" name="ablum"-->
<!--                                               class="form-control"-->
<!--                                               id="recipient-name"-->
<!--                                               required="required">-->
<!--                                    </div>-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="message-text"-->
<!--                                               class="col-form-label">Comment:</label>-->
<!--                                        <textarea name="comment"-->
<!--                                                  class="form-control"-->
<!--                                                  id="message-text"></textarea>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="modal-footer">-->
<!--                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close-->
<!--                                    </button>-->
<!--                                    <button type="submit" name="create" class="btn btn-primary">Send message</button>-->
<!--                                </div>-->
<!--                            </form>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <!--        <a class="p-2 text-dark" style="background: url(./img/1.svg);" href="#">Create new</a>-->-->
<!--        --><?php //else: ?>
<!--            <a href="signin.php" class="btn btn-outline-primary">signin</a>-->
<!--        --><?php //endif; ?>
<!--    </nav>-->
<!--</header>-->
<header>
    <div class="bg-dark collapse" id="navbarHeader" style="">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Follow on Twitter</a></li>
                        <li><a href="#" class="text-white">Like on Facebook</a></li>
                        <li><a href="#" class="text-white">Email me</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                <strong>Album</strong>
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>
<main class="container" role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Album example</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
            <p>
                <a href="#" class="btn btn-primary my-2">Main call to action</a>
                <a href="#" class="btn btn-secondary my-2">Secondary action</a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php
                $ablum = new ablum();
                $list = $ablum->Ablum('select', 'demo');
                $count = sizeof($list) > 3 ? '3' : sizeof($list);
                for ($i = 0; $i < $count; $i++): ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top"
                                 data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                                 alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                                 src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_176e15555ee%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_176e15555ee%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.71875%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                 data-holder-rendered="true">
                            <div class="card-body">
                                <p class="card-text">This is a wider card with supporting text below as a natural
                                    lead-in to additional content. This content is a little bit longer.</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <?php if (sizeof($list) > 3): ?>
        <div class="container">
            <div class="row">
                <div class="text-center ">
                    <a href="javascript:;">more</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?= $footer; ?>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
    $("#logout").click(function () {
        $.ajax({
            type: 'POST',
            url: 'home.php',
            data: {'action': 'logout'}
        })
    })
</script>
