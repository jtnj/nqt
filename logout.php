<?php
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['reset'])){
	unset($_SERVER['PHP_AUTH_USER']);
	unset($_SERVER['PHP_AUTH_PW']);
	unset($_POST['reset']);
	session_destroy();
	header("Location: index.php");
}
?>

<form action="logout.php" method="post">
	<input type="hidden" value="1" name="reset" /> <input type="submit"
		value="Reset" />
</form>