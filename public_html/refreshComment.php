<?php
include_once 'private/Story.php';
include_once 'private/User.php';
include_once 'private/Comment.php';
session_start();
$email = $_SESSION['email'];
$storyId = $_POST['storyId'];
$commentId = $_POST['commentId'];
$content = $_POST['content'];
if($email == null){
    header("Location: refreshComment.php");
}else{
    Comment::Delete($commentId);
    $comment = Comment::Create($storyId, $email, $content);
    $comment->Save();
    header("Location: selfPage.php");
}

?>