<?php
include_once 'private/Story.php';
include_once 'private/User.php';
include_once 'private/Comment.php';
session_start();
$storyId = $_POST['storyId'];
$comment_content = $_POST['content'];
$comment_author = $_SESSION['email'];
if($comment_author == null || $comment_content == null){
    header("Location: indexAfterSignIn.php");
}else{
    $comment = Comment::Create($storyId, $comment_author, $comment_content);
    $comment->Save();
    header("Location: indexAfterSignIn.php");
}

?>