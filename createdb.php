<?php 
/*require_once('functions.php');

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['reset'])){
	unset($_SERVER['PHP_AUTH_USER']);
 	unset($_SERVER['PHP_AUTH_PW']);
 	unset($_POST['reset']);
 	header("Location: index.php");
}

if (!isset($_SERVER['PHP_AUTH_USER'])) {
	header('WWW-Authenticate: Basic realm="My Realm"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Text to send if user hits Cancel button';
	exit;
} else {
	if ($_SERVER['PHP_AUTH_USER'] != $_SERVER['PHP_AUTH_PW']) {
		header('WWW-Authenticate: Basic realm="Wrong Username & Password"');
		header('HTTP/1.0 401 Unauthorized');
		echo 'Txt to send if user hits Cancel button';
		exit;
	} else {
		dbConnect();
		$tableName = $_SERVER['PHP_AUTH_USER'];
		createdb($tableName);
		echo "successful";
	}
}*/
?>