<?php
/**
 * sign up logic here: if you sign up successfully, you should insert data into database. Then jump to "indexAfterSignIn" page.
 */
include_once 'private/User.php';
session_start();
$nickName = $_POST['nickName'];
$email = $_POST['email'];
$passWord = $_POST['passWord'];
$user = User::SearchByEmail($email);
if($user != null){
    header("Location: signUp.html");
}else{
    $user = User::Create($email, $nickName, $passWord);
    $user->Save();
    header("Location: signIn.html");
}

?>