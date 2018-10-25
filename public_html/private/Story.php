<?php

include_once 'db.php';
include_once 'User.php';

class Story
{
    private $story_id;
    // the email of the author
    private $story_author;
    public $title;
    public $link;
    public $content;

    private function __construct($story_id, $story_author, $title, $link, $content) {
        $this->story_id = $story_id;
        $this->story_author = $story_author;
        $this->title = $title;
        $this->link = $link;
        $this->content = $content;
    }

    public function GetStoryID() {
        return $this->story_id;
    }

    public function GetStoryAuthor() {
        return $this->story_author;
    }

    public static function Create($story_author, $title, $link, $content) {
        // the author must exist
        // otherwise it will return null
        $user = User::SearchByEmail($story_author);
        if($user == null) {
            return null;
        }
        $story_id = uniqid();
        return new Story($story_id, $story_author, $title, $link, $content);
    }

    public static function Delete($story_id) {
        global $mysqli;
        $stmt = $mysqli->prepare("DELETE FROM stories WHERE story_id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s',$story_id);
        $stmt->execute();
        $stmt->close();
    }

    public static function GetAll() {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT story_id, title, link, content, story_author FROM stories");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->execute();
        $results = array();
        $stmt->bind_result($story_id, $title, $link, $content, $story_author);
        while($stmt->fetch()){
        //  push to array's back
            $results[] = new Story($story_id, $story_author, $title, $link, $content);
        }
        $stmt->close();
        return $results;
    }

    public static function SearchByAuthor($story_author) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT story_id, title, link, content FROM stories WHERE story_author=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s', $story_author);
        $stmt->execute();
        $results = array();
        $stmt->bind_result($story_id, $title, $link, $content);
        while($stmt->fetch()){
            //  push to array's back
            $results[] = new Story($story_id, $story_author, $title, $link, $content);
        }
        $stmt->close();
        return $results;
    }

    public static function SearchByID($story_id) {
        global $mysqli;
        $stmt = $mysqli->prepare("SELECT title, link, content, story_author FROM stories WHERE story_id=?");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('s', $story_id);
        $stmt->execute();
        $stmt->bind_result($title, $link, $content, $story_author);

        if ($stmt->fetch()) {
            $stmt->close();
            return new Story($story_id, $story_author, $title, $link, $content);
        }
        return null;
    }

    public function Save() {
        global $mysqli;
        $stmt = $mysqli->prepare("INSERT INTO stories (story_id, title, link, content, story_author) VALUES (?, ?, ?, ?, ?)");
        if(!$stmt){
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->bind_param('sssss',$this->story_id, $this->title, $this->link, $this->content, $this->story_author);
        $stmt->execute();
        $stmt->close();
    }
}
