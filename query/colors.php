<?php
include 'configuration.php';
$connect = getConnection();
//Создаем таблицу данных с цветами для разделов
$query = mysqli_query($connect,
    "CREATE TABLE IF NOT EXISTS colors (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    code VARCHAR (250) NOT NULL,
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