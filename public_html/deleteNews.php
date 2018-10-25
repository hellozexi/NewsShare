<?php
include_once 'private/Story.php';
include_once 'private/User.php';
session_start();
$story_id = $_POST['storyId'];
if($story_id == null){
    header("Location: selfPage.php");
}else{
    Story::Delete($story_id);
    header("Location: selfPage.php");
}

?>