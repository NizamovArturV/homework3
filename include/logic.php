<?php
$sessionLifeTime = 3600 * 24 * 30;
session_set_cookie_params($sessionLifetime);
session_start();

include 'logins.php'; 
include 'passwords.php'; 
include 'main_menu.php'; 
$success = false;
$error = false;

//Установка в куки раннее введеного логина 
if (isset($_COOKIE['login'])) {
    setcookie('login', $_COOKIE['login'], time() + (3600 * 24 * 30), '/');
}

//Проверка логина и пароля 
if (isset($_POST['login'])) {
    $loginUser = (isset($_COOKIE['login'])) ? $_COOKIE['login'] : $_POST['login_input'];
    $idUser = array_search($loginUser,$logins);
    
    if ($passwords[$idUser] === $_POST['password_input'] && $idUser !== false) {
        $success = true;
        $_SESSION['login'] = 'success';
        setcookie('login', $loginUser, time() + (3600 * 24 * 30), '/');
    } else {
        $error = true;
    }
}

//Выход из аккаунта
if (isset($_POST['unAuth'])) {
    session_destroy();
    header ('Location: /');
    exit;
}

//Перенаправлять неавторизованных пользователей на главную страницу
if ($_SERVER['REQUEST_URI'] !== '/' && $_SESSION['login'] !== 'success' && empty($_GET)) {
    header ('Location: /');
    exit;
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
