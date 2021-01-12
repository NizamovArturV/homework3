<?php
$sessionLifeTime = 3600 * 24 * 30;
session_set_cookie_params($sessionLifeTime);
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
    $passwordUser = $_POST['password_input'];
    include $_SERVER['DOCUMENT_ROOT'] . '/query/configuration.php';
    $query = mysqli_query($connect,
//        "SELECT * FROM users WHERE email= '$loginUser' AND password='$passwordUser'");
"SELECT users.*, g.name as group_name, g.description as group_description FROM users
        Left Join group_user gu on users.id = gu.user_id
        left join groups g on gu.group_id = g.id
        where users.email = '$loginUser' and users.password = '$passwordUser'");
    $result = mysqli_fetch_assoc($query);
    if (!empty($result)) {
        $success = true;
        $_SESSION['login'] = 'success';
        setcookie('login', $loginUser, time() + (3600 * 24 * 30), '/');
        $_SESSION['user_info'] = $result;
    } else {
        $error = true;
    }
    mysqli_close($connect);
}

//Выход из аккаунта
if (isset($_POST['unAuth'])) {
    session_destroy();
    header ('Location: /');
    exit();
}

//Перенаправлять неавторизованных пользователей на главную страницу
if ($_SERVER['REQUEST_URI'] !== '/' && $_SESSION['login'] !== 'success' && empty($_GET)) {
    header ('Location: /');
    exit();
}
//Функция обрезки строки, если она больше 15 символов 
function cutString($line, $length = 12, $appends = '...') : string
{
    return (strlen($line) > 15) ? mb_substr($line,0,$length) . $appends : $line;
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
