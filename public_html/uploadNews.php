<?php
include_once 'private/Story.php';
include_once 'private/User.php';
session_start();
$story_author = $_SESSION['email'];
$story_title = $_POST['title'];
$story_content = $_POST['content'];
$story_link = $_POST['link'];
if($story_author == null || $story_content == null){
    header("Location: indexAfterSignIn.php");
}else{
    $story3 = Story::Create($story_author, $story_title, $story_link, $story_content);
    $story3->Save();
    header("Location: indexAfterSignIn.php");
}

?>