<?php
include 'logins.php'; 
include 'passwords.php'; 

$success = false;
$error = false;

if (isset($_POST['login'])) {
    $idUser = array_search($_POST['login_input'],$logins);
    if ($passwords[$idUser] === $_POST['password_input'] && $idUser !== false) {
        $success = true;
    } else {
        $error = true;
    }
}
