<?php
include_once 'private/Story.php';
include_once 'private/User.php';
include_once 'private/Comment.php';
session_start();
$commentId = $_POST['commentId'];
if($commentId == null){
    header("Location: selfPage.php");
}else{
    Comment::Delete($commentId);
    header("Location: selfPage.php");
}

?>