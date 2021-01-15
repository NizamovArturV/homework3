<?php
include 'configuration.php';
$connect = getConnection();
//Создаем таблицу данных с сообщениями
$query = mysqli_query($connect,
    "CREATE TABLE IF NOT EXISTS messages (
    id INT NOT NULL AUTO_INCREMENT,
    text TEXT NOT NULL,
    title VARCHAR(255) NOT NULL,
    create_date DATETIME NOT NULL,
    user_sender INT NOT NULL,
    user_recipient INT NOT NULL,
    section_id INT NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT FK_user_sender_id FOREIGN KEY (user_sender)  REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT FK_user_recipient_id FOREIGN KEY (user_recipient)  REFERENCES users (id) ON DELETE CASCADE,
    CONSTRAINT FK_message_section_id FOREIGN KEY (section_id)  REFERENCES message_sections (id) ON DELETE CASCADE
    );");

if ($query === true) {
    echo 'Таблица создана успешно';
} else {
    $sqlError = mysqli_error($connect);
    echo 'Ошибка при создании таблицы' . $sqlError;
}

mysqli_close($connect);