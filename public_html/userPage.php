<?php
include_once 'private/User.php';
include_once 'private/Story.php';
session_start();
$email = $_POST['user'];
$nickName = $_SESSION['nickName'];
$token = $_SESSION['token'];
if($email == null || $nickName == null){
    header("Location: signIn.html");
}
$user = User::SearchByEmail($email);
if($user == null){
    header("Location: indexAfterSignIn.php");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="logo.ico">

    <title>userPage</title>

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
                <a class="nav-link" href="selfPage.php"><?php echo "Hi $nickName" ?> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="uploadNews1.php">Upload News</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="https://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Edit</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="editNews.php">Edit News</a>
                    <a class="dropdown-item" href="editComments.php">Edit Comments</a>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="index.php">Log out</a>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">

    <h1>Welcome to <?php echo "$email"?> Home</h1>
    <div align="left" style="float: left">
        <h2>News</h2>
        <?php
        include_once 'private/Story.php';
        $stories = Story::SearchByAuthor($email);

        foreach ($stories as $my_story) {
            $storyId = $my_story->GetStoryID();
            $content = substr($my_story->content, 0, 50);
            echo "<div class=\"col-md-6\">
            <div align='left' style='float: left' class=\"card flex-md-row mb-4 shadow-sm h-md-250\">
                <div class=\"card-body d-flex flex-column align-items-start\">
                    <strong class=\"d-inline-block mb-2 text-primary\">$my_story->title</strong>
                    <h3 class=\"mb-0\">
                        <a class=\"text-dark\" href=\"#\">$my_story->author</a>
                    </h3>
                    <p class=\"card-text mb-auto\">$content</p>
                    <form method='post'>
                        <input type='hidden' name='token' value='$token'>


                        <input name='storyId' type='hidden' value='$storyId'>                                         
                    </form>
                </div>            
            </div>          
        </div>";

        }
        ?>
    </div>
    <div align="right" style="float:right">
        <h2>Comments</h2>
        <?php
        include_once 'private/Comment.php';
        $comments = Comment::SearchByAuthor($email);
        foreach ($comments as $comment){
            $commentId = $comment->GetCommentID();
            $storyId = $comment->GetStoryID();
            $relatedStory = Story::SearchByID($storyId);
            $storyTitle = $relatedStory->title;
            $content = $comment->content;
            echo "<div class=\"media text-muted pt-3\">
        <p class=\"media-body pb-3 mb-0 small lh-125 border-bottom border-gray\">
        <strong class=\"d - block text - gray - dark\">$storyTitle</strong>
            $comment->content
        </p>     
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
