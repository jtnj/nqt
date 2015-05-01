<?php 
session_start();
if (!isset($_SESSION['db'])){
	header("Location: index.php");
}
require_once 'funcs.php';


global $events;
readF($_SESSION['db']);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if ($_POST['command'] == 'doAdd'){
		addEvent($events, $_POST['detail'], $_POST['month'], $_POST['day']);
		writeF($_SESSION['db']);
		header("Location: edit.php");
	}
}
get_header();
?>
<body>
	<form action='eAdd.php' method='post'>
		Nội Dung: <input type="text" name="detail" autofocus size="80" /> <br />
		Âm lịch: <input type="number" max="31" min="1" id="day" name="day" placeholder="Ngày" size="2" /><input type="number" max="12" min="1" id="month" name="month" placeholder="Tháng" size="2" />
		<input type="hidden" name="command" value="doAdd" /> <input type="submit" />
	</form>
	<a href="edit.php">Huỷ</a>
</body>
