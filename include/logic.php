<?php
include 'logins.php'; 
include 'passwords.php'; 
include 'main_menu.php'; 
$success = false;
$error = false;

//Проверка логина и пароля 
if (isset($_POST['login'])) {
    $idUser = array_search($_POST['login_input'],$logins);
    if ($passwords[$idUser] === $_POST['password_input'] && $idUser !== false) {
        $success = true;
    } else {
        $error = true;
    }
}

//Функция обрезки строки, если она больше 15 символов 
function cutString($line, $length = 12, $appends = '...') : string
{
    if (strlen($line) > 15) {
        $line = mb_substr($line,0,$length) . $appends;
    }
    return $line;
}

//Фукнция сортировки массива по ключу sort
function arraySort(array &$array, $key = 'sort', $sort = SORT_ASC)
{
    usort ($array, function ($a, $b) use ($key,$sort)
    {
        return ($sort == SORT_ASC) ? $a[$key] <=> $b[$key] : $b[$key] <=> $a[$key];
    });
}

//Функция вывода заголовка
function showTitle($menu)
{
    foreach ($menu as $menuItem) {
        if ($menuItem['path'] == $_SERVER['REQUEST_URI']) {
            return $menuItem['title'];
        }
    }
}

//Функция отображения меню
function showMenu($menu, $sortType = SORT_ASC)
{
    arraySort($menu,'sort',$sortType);
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php';
}
