<?php
include 'configuration.php';
$connect = getConnection();
//Создаем таблицу данных с цветами для разделов
$query = mysqli_query($connect,
    "CREATE TABLE IF NOT EXISTS sections (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    color_id INT,
    create_date DATETIME NOT NULL,
    user_id INT NOT NULL,
    PRIMARY KEY (id),
    UNIQUE INDEX NAME_UNIQUE (name),
    CONSTRAINT FK_color_section FOREIGN KEY (color_id)  REFERENCES colors (id) ON DELETE CASCADE,
    CONSTRAINT FK_section_user FOREIGN KEY (user_id)  REFERENCES users (id) ON DELETE CASCADE
    );");

if ($query === true) {
    echo 'Таблица создана успешно';
} else {
    $sqlError = mysqli_error($connect);
    echo 'Ошибка при создании таблицы' . $sqlError;
}

mysqli_close($connect);
