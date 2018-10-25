<?php
include_once 'private/Story.php';
include_once 'private/User.php';
session_start();
$story_author = $_SESSION['email'];
$story_title = $_POST['title'];
$story_content = $_POST['content'];
$story_link = $_POST['link'];
$story_id = $_POST['storyId'];
if($story_author == null){
    header("Location: refreshNews.php");
}else{
    Story::Delete($story_id);
    $story = Story::Create($story_author, $story_title, $story_link, $story_content);
    $story->Save();
    header("Location: selfPage.php");
}

?>