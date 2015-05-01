<?php
session_start();
if (!isset($_SESSION['db'])){
	header("Location: index.php");
}
require_once('funcs.php');
global $events;
readF($_SESSION['db']);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	if ($_POST['command'] != 'edit' && $_POST['command'] != 'del' && $_POST['command'] != 'doEdit' && $_POST['command'] != 'doDel'){
		header("Location: edit.php");
	}

	if ($_POST['command'] == 'doEdit'){
		updateEvent($_POST['id'], $_POST['detail'], $_POST['month'], $_POST['day']);
		writeF($_SESSION['db']);
		header("Location: edit.php");
	}

	if ($_POST['command'] == 'doDel'){
		deleteEvent($_POST['id']);
		writeF($_SESSION['db']);
		header("Location: edit.php");
	}
} else {
	header("Location: edit.php");
}

get_header();
?>
<body>
<?php
//echo $_POST['id'];
$event = getEvent($_POST['id']);
if ($_POST['command'] == 'edit'){
	?>
<form action='eEdit.php' method='post'>
	<input type='hidden' name='id' value='<?php echo $event->id; ?>' /> Nội
	dung: <input type="text" name="detail" size="80"
		value="<?php echo $event->detail; ?>" /> <br />Âm lịch: <input type="number" max="31" min="1"
		id="day" name="day" value="<?php echo $event->day; ?>" />/<input
		type="number" max="12" min="1" id="month" name="month"
		value="<?php echo $event->month; ?>" />
		<input type="hidden" name="command" value="doEdit" /> <input
		type="submit" value="OK" />
</form>
<a href="edit.php">Huỷ</a>
<?php
} else {
?>
<form action='eEdit.php' method='post'>
	<input type='hidden' name='id' value='<?php echo $event->id ?>' /> <input
		type='hidden' name='command' value='doDel' /> Xóa
	<?php echo $event->detail; ?>
	? <input type="submit" class="submitLink" value="Xoá" /> <a
		href="edit.php">Không</a>
</form>
<?php 
}
?>
</body>