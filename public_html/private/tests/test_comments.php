<html>
<head>
    <title>test stories</title>
</head>
<body>
<?php
include_once 'private/Story.php';
include_once 'private/User.php';
include_once 'private/Comment.php';

function mylog($msg) {
    echo '<p>'.$msg.'</p>';
}

$user = User::Create('xua@wustl', 'xua', 'sdfsd');
$user->Save();
$another_user = User::Create('jason@wustl', 'jason', '124234sda');
$another_user->Save();

$story = Story::Create('xua@wustl', 'today-offer', 'http://url', 'bababalabablablablbalablbalb');
$story->Save();
$story1 = Story::Create('xua@wustl', 'today', 'http://url', 'bababalabablablablbalablbalb');
$story2 = Story::Create('jason@wustl', 'yesterday', 'http://url', 'babasdfsdafasfsafsafsdfsaflb');
$story3 = Story::Create('jason@wustl', 'tomorrow', 'http://url', 'sdfssdfsdffffffffafsafsfsadfsaf');
$story1->Save();
$story2->Save();
$story3->Save();

$com1 = Comment::Create($story->GetStoryID(), 'jason@wustl', 'comment1');

mylog($com1->GetCommentID());
mylog($com1->GetStoryID());
mylog($com1->GetCommentAuthor());
mylog($com1->content);

$com2 = Comment::Create($story->GetStoryID(), 'jason@wustl', 'comment2');
$com3 = Comment::Create($story->GetStoryID(), 'jason@wustl', 'comment3');
$com1->Save();
$com2->Save();
$com3->Save();

$comments = Comment::SearchByStory($story->GetStoryID());
foreach ($comments as $comment) {
    mylog($comment->content);
}

Comment::Delete($com2->GetCommentID());

$comments = Comment::SearchByAuthor('jason@wustl');
foreach ($comments as $comment) {
    mylog($comment->content);
}

?>
</body>
</html>