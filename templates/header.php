<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/logic.php'; ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="/styles.css" rel="stylesheet">
        <title>Project - ведение списков</title>
    </head>

<body>

    <div class="header">
        <div class="logo"><img src="/i/logo.png" width="68" height="23" alt="Project"></div>
        <div class="clearfix"></div>
    </div>

    <div class="clear">
        <?= showMenu($mainMenu) ?>
    </div>

<?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'success') : ?>
    <form action="" method="POST">
        <input type="submit" value="Выйти" name="unAuth">
    </form>
<?php endif; ?>