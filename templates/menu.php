<ul class="main-menu <?= $position ?>">
    <?php foreach ($menu as $menuItem):
        $menuItem['current'] = ($menuItem['path'] == $_SERVER['REQUEST_URI']) ? true : false; ?>
        <li>
            <a href="<?= $menuItem['path'] ?>"
               style="text-decoration: <?= $menuItem['current'] ? 'underline' : 'none' ?>">
                <?= cutString($menuItem['title']) ?>
            </a>
        </li>
    <?php endforeach; ?>

    <?php if (isAuth()) : ?>
        <li><a href="/profile.php">Профиль</a></li>
    <?php endif; ?>

</ul>

