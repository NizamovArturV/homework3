<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = 'root';
$dbname = 'task_db';

$connect = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if (mysqli_connect_errno()) {
    die ('Не удалось подключится к базе данных' . mysqli_connect_error());
}