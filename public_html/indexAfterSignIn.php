<?php
include_once 'private/Story.php';
session_start();
$nickName = $_SESSION['nickName'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="logo.ico">

    <title>index after sign in</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/docs/4.1/examples/starter-template/starter-template.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">News</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="selfPage.php"><?php echo "$nickName" ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="uploadNews1.php">Upload News</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="index.php">Log out</a>
            </li>
        </ul>
        <form method="post" class="form-inline my-2 my-lg-0" action="userPage.php">
            <input name="user" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<main role="main" class="container">

    <div class="starter-template">
        <h1>News here</h1>
        <?php
        include_once 'private/Story.php';
        $token = $_SESSION['token'];
        $stories = Story::GetAll();
        foreach ($stories as $my_story) {
            $storyId = $my_story->GetStoryID();
            $content = substr($my_story->content, 0, 50);

            echo "<div class=\"col-md-6\">
            <div class=\"card flex-md-row mb-4 shadow-sm h-md-250\">
                <div class=\"card-body d-flex flex-column align-items-start\">
                    <strong class=\"d-inline-block mb-2 text-primary\">$my_story->title</strong>
                    <h3 class=\"mb-0\">
                        <a class=\"text-dark\" href=\"#\">$my_story->author</a>
                    </h3>
                    <p class=\"card-text mb-auto\">$content</p>
                    <form method='post'>
                        <input type='hidden' name='token' value='$token'>
                        <input name='storyId' type='hidden' value='$storyId'>
                        <div align='left' style='float:left'>
                            <button class=\"btn btn-sm btn-primary btn-block\" type=\"submit\" formaction='moreDetail.php'>Continue Reading</button>                          
                        </div>
                    </form>
                </div>
             
            </div>
        </div>";

        }
        ?>
    </div>

</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="http://getbootstrap.com/docs/4.1/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="http://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>
<script src="http://getbootstrap.com/docs/4.1/dist/js/bootstrap.min.js"></script>
</body>
</html>