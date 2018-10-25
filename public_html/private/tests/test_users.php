<?php

include_once 'private/User.php';

$user = User::Create("xua@wustl", "xua", "t4234");

//echo 'email      ';
//echo $user->GetEmail();
//echo 'nickname    ';
//echo $user->GetNickname();
//if ($user->Validate("t4234")) {
//    echo 'yes';
//}
//else {
//    echo 'no';
//}

$user->Save();

$new_one = User::SearchByEmail('xua@wustl');
if ($new_one == null) {
    echo 'account does not exist ';
}
else {
    if ($new_one->Validate("t4234")) {
        echo 'yes';
    }
    else {
        echo 'no';
    }
}

$another = User::SearchByEmail('xua');
if ($another == null) {
    echo 'account does not exist ';
}