<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$sessionLifeTime = 3600 * 24 * 30;
session_set_cookie_params($sessionLifeTime);
session_start();

include $_SERVER['DOCUMENT_ROOT'] . '/include/main_menu.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/configuration.php';
$success = false;
$error = false;

//Определение логина пользователя
if (isset($_COOKIE['login'])) {
    $loginUser = $_COOKIE['login'];
} elseif (isset($_POST['login_input'])) {
    $loginUser = $_POST['login_input'];
}

//Проверка авторизации пользователя
function isAuth()
{
    return isset($_SESSION['login']) && $_SESSION['login'] === 'success';
}

//Установка в куки раннее введеного логина 
if (isset($_COOKIE['login'])) {
    setcookie('login', $_COOKIE['login'], time() + (3600 * 24 * 30), '/');
}

//Получение информации о пользователе по логину
function getUserByLogin($loginUser)
{
    $connect = getConnection();
    $queryUserInfo = mysqli_query($connect,
        "SELECT * FROM users where users.email = '$loginUser'");
    $result = mysqli_fetch_assoc($queryUserInfo);

    return $result;
}

//Получение информации о группах пользователя по логину
function getUserGroupsInfo($loginUser)
{
    $connect = getConnection();
    $queryGroupsInfo = mysqli_query($connect,
        "SELECT g.name as group_name, g.description as group_description FROM users
            Left Join group_user gu on users.id = gu.user_id
            left join groups g on gu.group_id = g.id
            where users.email = '$loginUser'");
    while ($row = mysqli_fetch_assoc($queryGroupsInfo)) {
        $result[] = $row;
    }

    return $result;
}

//Проверка логина и пароля
if (isset($_POST['login']) && isset($loginUser) && isset($_POST['password_input'])) {
    $userInfo = getUserByLogin($loginUser);
    $groupInfo = getUserGroupsInfo($loginUser);
    $passwordHash = $userInfo['password'];
    $passwordUser = $_POST['password_input'];
    if (!empty($userInfo) && password_verify($passwordUser, $passwordHash) === true) {
        $success = true;
        $_SESSION['login'] = 'success';
        setcookie('login', $userInfo['email'], time() + (3600 * 24 * 30), '/');
        $_SESSION['user_info'] = $userInfo;
        $_SESSION['user_info']['groups_info'] = $groupInfo;
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
if ($_SERVER['REQUEST_URI'] !== '/' && isAuth() !== true && empty($_GET)) {
    header('Location: /');
    exit();
}
//Функция обрезки строки, если она больше 15 символов 
function cutString($line, $length = 12, $appends = '...'): string
{
    return (mb_strlen($line) > 15) ? mb_substr($line, 0, $length) . $appends : $line;
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
function showMenu($menu, $sortType = SORT_ASC, $position = '')
{
    arraySort($menu, 'sort', $sortType);
    include $_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php';
}

