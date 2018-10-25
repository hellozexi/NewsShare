<?php
include_once 'private/Story.php';
include_once  'private/User.php';
session_start();
$email = $_SESSION['email'];
$storyId = $_POST['storyId'];
$story = Story::SearchByID($storyId);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="logo.ico">

    <title>editNews</title>

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
                <a class="nav-link" href="indexAfterSignIn.php">Home <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<main role="main" class="container">
<?php
$token = $_SESSION['token'];
echo " <div class=\"starter-template\">
        <h1>Edit News</h1> <!--echo the news from database here and edit it -->
        <form method=\"post\" action=\"refreshNews.php\">
            Title:<br /><input name=\"title\" id=\"title\" type=\"Text\" size=\"50\" maxlength=\"50\" value=\"$story->title\"><br />
            Content:<br /><textarea name=\"content\" id=\"news\" cols=\"50\" rows=\"5\"  >$story->content</textarea><br />
            Link:<br /><input name=\"link\" id=\"link\" type=\"Text\" size=\"50\" maxlength=\"50\" value=\"$story->link\"><br />
            <input name='storyId' type='hidden' value='$storyId'> 
            <input type=\"hidden\" name=\"token\" value=\"$token\" />
            <br /><input type=\"Submit\" name=\"submit\" id=\"submit\" value=\"Enter News\">
        </form>
    </div>"
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
</html>


