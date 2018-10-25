<?php
include_once 'private/Story.php';
include_once 'private/User.php';
include_once 'private/Comment.php';
session_start();
$email = $_SESSION['email'];
$nickName = $_SESSION['nickName'];
$storyID = $_POST['storyId'];
$story = Story::SearchByID($storyID);
$author = $story->GetStoryAuthor();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="logo.ico">

    <title>moreDetail</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/docs/4.1/examples/starter-template/starter-template.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="indexAfterSignIn.php">News</a>
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
    </div>
</nav>

<main role="main" class="container">

    <div class="starter-template">
        <?php
        echo "<h1>$story->title</h1>";
        echo "<h5>Posted by $author</h5>";
        echo "<p>$story->content</p>";
        echo "<a href='$story->link'>$story->link</a>"
        ?>
    </div>
    <h6 class="border-bottom border-gray pb-2 mb-0">Comments</h6>
    <?php
    $comments = Comment::SearchByStory($storyID);
    foreach ($comments as $comment){
        $author = $comment->GetCommentAuthor();
        echo "<div class=\"media text-muted pt-3\">
        <img data-src=\"holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1\" alt=\"\" class=\"mr-2 rounded\">
        <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
            <strong class=\"d-block text-gray-dark\">$author</strong>
            $comment->content
        </p>
    </div>";
    }
    ?>
    <h1>Upload Comments</h1>
    <?php
    $token = $_SESSION['token'];
    echo " <form method=\"post\" action=\"uploadComments.php\">
             <input type='hidden' name='token' value='$token'>

        Content:<br /><textarea name=\"content\" id=\"comments\" cols=\"50\" rows=\"5\"></textarea><br />
        <input type=\"hidden\" name=\"storyId\" value=\"$storyID\">
        <br /><input type=\"Submit\" name=\"submit\" id=\"submit\" value=\"Enter Comments\">
    </form>";
    ?>

</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="http://getbootstrap.com/docs/4.1/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="http://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script>
<script src="http://getbootstrap.com/docs/4.1/dist/js/bootstrap.min.js"></script>
</body>


