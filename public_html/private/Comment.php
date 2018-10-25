<?php

include_once 'db.php';
include_once 'User.php';
include_once 'Story.php';

class Comment
{
    private $comment_id;
    private $story_id;
    private $comment_author;
    public $content;

    private function __construct($comment_id, $story_id, $comment_author, $content) {
        $this->comment_id = $comment_id;
        $this->story_id = $story_id;
        $this->comment_author = $comment_author;
        $this->content = $content;
    }

    public function GetCommentID() {
        return $this->comment_id;
    }

    public function GetStoryID() {
        return $this->story_id;
    }

    public function GetCommentAuthor() {
        return $this->comment_author;
    }

    public static function Create($story_id, $comment_author, $content) {
        $user = User::SearchByEmail($comment_author);
        if($user == null) {
            return null;
        }
        $story = Story::SearchByID($story_id);
        if($story == null) {
            return null;
        }
        $comment_id = uniqid();
        return new Comment($comment_id, $story_id, $comment_author, $content);
    }

    public function Save() {
        global $mysqli;
        $stmt = $mysqli->prepare("INSERT INTO comments (comment_id, story_id, comment_author, content) VALUES (?, ?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('ssss',$this->comment_id, $this->story_id, $this->comment_author, $this->content);
        $stmt->execute();
        echo $stmt->error;
        $stmt->close();
    }

    public static function Delete($comment_id) {
        global $mysqli;
        $stmt = $mysqli->prepare("DELETE FROM comments WHERE comment_id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s',$comment_id);
        $stmt->execute();
        $stmt->close();
    }

    public static function SearchByStory($story_id) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT comment_id, comment_author, content FROM comments WHERE story_id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s', $story_id);
        $stmt->execute();
        $results = array();
        $stmt->bind_result($comment_id, $comment_author, $content);
        while($stmt->fetch()){
            //  push to array's back
            $results[] = new Comment($comment_id, $story_id, $comment_author, $content);
        }
        $stmt->close();
        return $results;
    }

    public static function SearchByAuthor($comment_author) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT comment_id, story_id, content FROM comments WHERE comment_author=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s', $comment_author);
        $stmt->execute();
        $results = array();
        $stmt->bind_result($comment_id, $story_id, $content);
        while($stmt->fetch()){
            //  push to array's back
            $results[] = new Comment($comment_id, $story_id, $comment_author, $content);
        }
        $stmt->close();
        return $results;
    }
}

//CREATE TABLE IF NOT EXISTS comments (
//    `comment_id` VARCHAR(30),
//    `story_id` VARCHAR(30),
//    `comment_author` VARCHAR(30) NOT NULL,
//    `content` TEXT NOT NULL,
//    PRIMARY KEY(`comment_id`),
//    FOREIGN KEY (`story_id`) references `stories` (`story_id`),
//    FOREIGN KEY (`comment_author`) references `users` (`email`)
//) engine = InnoDB default CHARACTER SET = utf8 collate = utf8_general_ci;