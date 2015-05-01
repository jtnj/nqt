<?php
session_start();
if (isset($_SESSION['db'])){
	header("Location: edit.php");
}

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['reset'])){
	unset($_SERVER['PHP_AUTH_USER']);
	unset($_SERVER['PHP_AUTH_PW']);
	unset($_POST['reset']);
	session_destroy();
	header("Location: index.php");
}


if (!isset($_SERVER['PHP_AUTH_USER'])) {
	header('WWW-Authenticate: Basic realm="My Realm"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Die..';
	exit;
} else {
	if ($_SERVER['PHP_AUTH_USER'] != $_SERVER['PHP_AUTH_PW']) {
		header('WWW-Authenticate: Basic realm="Wrong"');
		header('HTTP/1.0 401 Unauthorized');
		echo 'Die';
		exit;
	} else {
		if (!file_exists($_SERVER['PHP_AUTH_USER'])){
			header('WWW-Authenticate: Basic realm="Wrong details"');
			header('HTTP/1.0 401 Unauthorized');
			echo 'Die.';
			exit;
		} else {
			$_SESSION['db'] = $_SERVER['PHP_AUTH_USER'];
			header("Location: edit.php");
		}
?>
<form action="index.php" method="post">
	<input type="hidden" value="1" name="reset" /> <input type="submit"
		value="Reset" />
</form>
<?php
	}
}

?>