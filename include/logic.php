<?php

$login = 'artur';
$password = '12345';
$success = false;
$error = false;

if (isset($_POST['login'])) {
    if ($_POST['login_input'] === $login && $_POST['password_input'] === $password) {
        $success = true;
    } else {
        $error = true;
    }
}
