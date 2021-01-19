<?php
//Функция получения соединения с БД
function getConnection()
{
    static $connect;
    $dbHost = 'localhost';
    $dbUser = 'root';
    $dbPassword = 'root';
    $dbName = 'task_db';
    if (empty($connect)) {
        $connect = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
        if (mysqli_connect_errno()) {
            die ('Не удалось подключится к базе данных' . mysqli_connect_error());
        }
    }

    return $connect;
}