<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

<?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'success') : ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="submit" value="Выйти" name="unAuth">
    </form>
<?php endif; ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="left-collum-index">
                <h1>Профиль пользователя</h1>
                <p>Фио: <?= $_SESSION['user_info']['name'] ?></p>
                <p>Email: <?= $_SESSION['user_info']['email'] ?></p>
                <p>Телефон: <?= $_SESSION['user_info']['phone'] ?></p>
                <p>Группа: <?= $_SESSION['user_info']['group_name'] ?></p>
                <p>Описание группы: <?= $_SESSION['user_info']['group_description'] ?></p>
            </td>
        </tr>
    </table>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>