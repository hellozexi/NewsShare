<?php
/**
 * Check the database.
 * If you sign in successfully, you should redirect to "indexAfterSignIn" page.
 */
include_once 'private/User.php';
session_start();
$email = $_POST['email'];
$password = $_POST['password'];
$user = User::SearchByEmail($email);
if ($user == null) {
    echo 'account does not exist ';
}
else {
    if ($user->Validate($password)) {
        $_SESSION['nickName'] = $user->nickname;
        $_SESSION['email'] = $user->GetEmail();
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        header("Location: indexAfterSignIn.php");
    }
    else {
        echo 'Wrong password, try again';
    }
}
?>