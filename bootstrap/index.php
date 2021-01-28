<?php

use boot\ablum;

include_once "functions.php";

$page = 1;
if (!empty($_GET['page'])) $page = $_GET['page'];

if (isset($_POST['action'])) {
	header("location:./signin.php");
	setcookie("log", '');
}
if (!checkLog()) {
	header("location:./signin.php");
}

$ablum = new ablum();

if(isset($_POST['dele'])){
	echo $_POST['name123'];
//	if($ablum->Ablum('delete', 'admin', $_POST['name'])){
//		echo "<script>alert('1')</script>";
//	}
//	else{
//		echo "<script>alert('0')</script>";
//	}

}
?>
<?= $header; ?>

<header>
    <div class="bg-dark collapse" id="navbarHeader" style="">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">Add some information about the album below, the author, or any other
                        background context. Make it a few sentences long so folks can pick up some informative tidbits.
                        Then, link them off to some social networking sites or contact information.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Follow on Twitter</a></li>
                        <li><a href="#" class="text-white">Like on Facebook</a></li>
                        <li><a href="#" class="text-white">Email me</a></li>
                    </ul>
                </div>
                <form method="post">
                    <button type="submit" name="action" class="btn btn-outline-primary">LogOut</button>
                </form>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
                <strong>Album</strong>
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarHeader"
                    aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

        </div>
    </div>
</header>
<main class="container" role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Album example</h1>
            <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator,
                etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
            <p>
            <p>
                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                        data-target="#exampleModalCenter">
                    Create
                </button>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="index.php">
<!--                                <input type="hidden" value="--><?//= $_COOKIE['log']; ?><!--" name="user">-->
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="recipient-name"
                                               class="col-form-label">Album
                                            name:</label>
                                        <input type="text" name="ablum"
                                               class="form-control"
                                               id="recipient-name"
                                               required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text"
                                               class="col-form-label">Comment:</label>
                                        <textarea name="comment"
                                                  class="form-control"
                                                  id="message-text"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                    </button>
                                    <button type="submit" name="create" class="btn btn-primary">Send message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </p>
        </div>
    </section>

	<?php
	$list = $ablum->Ablum('select', 'admin');
	$size = sizeof($list) > $page * 9 ? $page * 9 : sizeof($list);
	for ($i = ($page - 1) * 9; $i < $size; $i++): ?>
        <form method="get">
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <p class="card-text"><?= $list[$i]['ablum']; ?></p>
                                <img class="card-img-top"
                                     data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                                     alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                                     src="./img/backiee.jpg"
                                     data-holder-rendered="true">
                                <div class="card-body">
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to additional content. This content is a little bit longer.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                            <input type="hidden" value="<?= $list[$i]['ablum']; ?>" name="name123">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary" name="dele">
                                                dele
                                            </button>
                                        </div>
                                        <small class="text-muted"><?= $list[$i]['date']; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        </form>
	<?php endfor; ?>

	<?php if (sizeof($list) > 9): ?>
        <!--        分页-->
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="First group">
				<?php
				$page = intval(sizeof($list) / 9) + 1;
				for ($i = 1; $i <= $page; $i++) {
					echo '<a href="?page=' . $i . '"><button type="button" class="btn btn-secondary">' . $i . '</button>';
				}
				?>
            </div>
        </div>
	<?php endif; ?>
	<?= $footer; ?>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>

    $.ajax({
        type: 'POST',
        url: 'https://ld.iobit.com/newsletter/2020hibella/data.php',
        data: {'data': 'eyJ1c2VyaW5mb'},
        success: function (res) {
            console.log(res);
        }
    })
</script>

