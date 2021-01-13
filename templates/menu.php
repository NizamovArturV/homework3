<li>
    <a href="<?= $menuItem['path'] ?>"
       style="text-decoration: <?= $menuItem['current'] ? 'underline' : 'none' ?>">
        <?= cutString($menuItem['title']) ?>
    </a>
</li>

