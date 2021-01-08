<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>

<?php if (isset($_SESSION['login']) && $_SESSION['login'] === 'success') : ?>
					<form action = "<?= $_SERVER['PHP_SELF'] ?>" method = "post">
						<input type="submit" value="Выйти" name="unAuth">
					</form>
<?php endif ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php';
?>