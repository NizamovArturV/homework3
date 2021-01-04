<?php foreach ($menu as $menuItem) { ?>
<li><a href="<?=$menuItem['path']?>"
<?php if ($menuItem['path'] == $_SERVER['REQUEST_URI']) { ?> style="text-decoration:underline;"<?php } ?>>
<?=cutString($menuItem['title'])?>
</a></li>
<?php } ?>
