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
        mylog($story->GetStoryID());
        mylog($story->GetStoryAuthor());
        mylog($story->title);
        mylog($story->link);
        mylog($story->content);
        $story->Save();
        $story1 = Story::Create('xua@wustl', 'today', 'http://url', 'bababalabablablablbalablbalb');
        $story2 = Story::Create('jason@wustl', 'yesterday', 'http://url', 'babasdfsdafasfsafsafsdfsaflb');
        $story3 = Story::Create('jason@wustl', 'tomorrow', 'http://url', 'sdfssdfsdffffffffafsafsfsadfsaf');
        $story1->Save();
        $story2->Save();
        $story3->Save();

        mylog('all stories');

        $stories = Story::GetAll();
        foreach ($stories as $my_story) {
            mylog($my_story->title);
        }

        mylog('searching stories for jason');

        $jason_stories = Story::SearchByAuthor($another_user->GetEmail());
        foreach ($jason_stories as $jason_story) {
            mylog($jason_story->title);
        }

        $fake_story = Story::Create('xua@scut', 'today-offer', 'http://url', 'bababalabablablablbalablbalb');
        if ($fake_story == null) {
            mylog('author not exist, story create failed.');
        }

        $search_story = Story::SearchByID($story->GetStoryID());
        if($search_story->GetStoryID() == $story->GetStoryID()) {
            mylog('search success');
            mylog('original story title:');
            mylog($story->title);
            mylog('search story title:');
            mylog($story->title);
        }

        mylog('testing delete');
        $com1 = Comment::Create($story1->GetStoryID(), 'jason@wustl', 'comment1');
        $com2 = Comment::Create($story->GetStoryID(), 'jason@wustl', 'comment2');
        $com3 = Comment::Create($story->GetStoryID(), 'jason@wustl', 'comment3');
        $com1->Save();
        $com2->Save();
        $com3->Save();

        mylog('adding comments1 2 3');
        $comments = Comment::SearchByAuthor('jason@wustl');
        foreach ($comments as $comment) {
            mylog($comment->content);
        }

        mylog('story deleted:');
        mylog($story->title);
        Story::Delete($story->GetStoryID());

        $comments = Comment::SearchByAuthor('jason@wustl');
        foreach ($comments as $comment) {
            mylog($comment->content);
        }

    ?>
    </body>
</html>