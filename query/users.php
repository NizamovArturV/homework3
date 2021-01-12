<?php
include 'configuration.php';

//Создаем таблицу данных с пользователями
$query = mysqli_query($connect,
    "CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR (255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    active INT NOT NULL DEFAULT 1,
    email_notifications INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    UNIQUE INDEX EMAIL_UNIQUE (email),
    UNIQUE INDEX TELEPHONE_UNIQUE (phone)
    );");

if ($query === true) {
    echo 'Таблица создана успешно';
} else {
    $sqlError = mysqli_error($connect);
    echo 'Ошибка при создании таблицы' . $sqlError;
}

mysqli_close($connect);