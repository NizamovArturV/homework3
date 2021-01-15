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
                <p>Группы пользователя:</p>
                <?php foreach ($_SESSION['user_info']['groups_info'] as $group): ?>
                <ul>
                    <li>Навание группы: <?= $group['group_name'] ?> Описание группы: <?=$group['group_description']?></li>
                </ul>
                <?php endforeach; ?>
            </td>
        </tr>
    </table>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>