<?php
$sessionLifeTime = 3600 * 24 * 30;
session_set_cookie_params($sessionLifeTime);
session_start();

include 'logins.php';
include 'passwords.php';
include 'main_menu.php';
include $_SERVER['DOCUMENT_ROOT'] . '/query/configuration.php';
$success = false;
$error = false;

//Установка в куки раннее введеного логина 
if (isset($_COOKIE['login'])) {
    setcookie('login', $_COOKIE['login'], time() + (3600 * 24 * 30), '/');
}

//Проверка логина и пароля
function authorization($loginUser, $passwordUser)
{
    $loginUser = (isset($_COOKIE['login'])) ? $_COOKIE['login'] : $loginUser;
    global $connect;
    $query = mysqli_query($connect,
        "SELECT users.*, g.name as group_name, g.description as group_description FROM users
        Left Join group_user gu on users.id = gu.user_id
        left join groups g on gu.group_id = g.id
        where users.email = '$loginUser' and users.password = '$passwordUser'");
    return $result = mysqli_fetch_assoc($query);
}

if (isset($_POST['login'])) {
    $userInfo = authorization($_POST['login_input'], $_POST['password_input']);
    if (!empty($userInfo)) {
        $success = true;
        $_SESSION['login'] = 'success';
        setcookie('login', $userInfo['email'], time() + (3600 * 24 * 30), '/');
        $_SESSION['user_info'] = $userInfo;
    } else {
        $error = true;
    }
}

//Выход из аккаунта
if (isset($_POST['unAuth'])) {
    session_destroy();
    header('Location: /');
    exit();
}

//Перенаправлять неавторизованных пользователей на главную страницу
if ($_SERVER['REQUEST_URI'] !== '/' && $_SESSION['login'] !== 'success' && empty($_GET)) {
    header('Location: /');
    exit();
}
//Функция обрезки строки, если она больше 15 символов 
function cutString($line, $length = 12, $appends = '...'): string
{
    return (strlen($line) > 15) ? mb_substr($line, 0, $length) . $appends : $line;
}

//Фукнция сортировки массива по ключу sort
function arraySort(array &$array, $key = 'sort', $sort = SORT_ASC)
{
    usort($array, function ($a, $b) use ($key, $sort) {
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
    arraySort($menu, 'sort', $sortType);
    foreach ($menu as $menuItem) {
        $menuItem['current'] = ($menuItem['path'] == $_SERVER['REQUEST_URI']) ? true : false;
        include $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php';
    }
}

mysqli_close($connect);
