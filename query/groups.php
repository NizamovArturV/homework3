<?php
include 'configuration.php';

//Создаем таблицу данных с группами пользователей
$query = mysqli_query($connect,
    "CREATE TABLE IF NOT EXISTS groups (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description VARCHAR (255),
    PRIMARY KEY (id),
    UNIQUE INDEX NAME_UNIQUE (name)
    );");

if ($query === true) {
    echo 'Таблица создана успешно';
} else {
    $sqlError = mysqli_error($connect);
    echo 'Ошибка при создании таблицы' . $sqlError;
}

mysqli_close($connect);
