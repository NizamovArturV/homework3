<?php
include 'configuration.php';

//Создаем таблицу данных со связями групп и пользователей
$query = mysqli_query($connect,
    "CREATE TABLE IF NOT EXISTS group_user (
    user_id INT NOT NULL,
    group_id INT NOT NULL,
    PRIMARY KEY (user_id, group_id),
    CONSTRAINT FK_user FOREIGN KEY (user_id)  REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT FK_group FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE 
    );");

if ($query === true) {
    echo 'Таблица создана успешно';
} else {
    $sqlError = mysqli_error($connect);
    echo 'Ошибка при создании таблицы' . $sqlError;
}

mysqli_close($connect);
