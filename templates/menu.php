<?php foreach ($menu as $menuItem) : ?>
<li><a href="<?= $menuItem['path'] ?>"
<?php if ($menuItem['path'] == $_SERVER['REQUEST_URI']) : ?> style="text-decoration:underline;"<?php endif; ?>>
<?=cutString($menuItem['title'])?>
</a></li>
<?php endforeach; ?>
