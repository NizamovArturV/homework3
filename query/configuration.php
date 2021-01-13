<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = 'root';
$dbName = 'task_db';

$connect = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);

if (mysqli_connect_errno()) {
    die ('Не удалось подключится к базе данных' . mysqli_connect_error());
}