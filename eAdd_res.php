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
		addEvent($events, $_POST['detail'], $_POST['year'], $_POST['month'], $_POST['day'], $_POST['revMonth'], $_POST['revDay'], $_POST['revYear']);
		writeF($_SESSION['db']);
		header("Location: edit.php");
	}
}
get_header();
?>
<body>
	<script>
$(document).ready(function(){
	$("#convertBtn").click(function(){
		var lunarMonth = parseInt($("#month").val());
		var lunarDay = parseInt($("#day").val());
		var year = parseInt($("#year").val());
		var leap = parseInt($('input[name="leap"]:checked').val());
		var timezone = 7.0;

		var solarDate = convertLunar2Solar(lunarDay, lunarMonth, year, leap, timezone);
		$("#revDay").val(solarDate[0]);
		$("#revMonth").val(solarDate[1]);
		$("#revYear").val(solarDate[2]);
	});
	
	$("#year").val((new Date).getFullYear());
	$("#revYear").val((new Date).getFullYear());
});
</script>
	<form action='eAdd.php' method='post'>
		Nội Dung: <input type="text" name="detail" autofocus size="80" /> <br />
		Âm lịch: <input
			type="number" max="31" min="1" id="day" name="day" placeholder="Ngày" size="10" />/<input
			type="number" max="12" min="1" id="month" name="month" placeholder="Tháng" size="10" /><input type="number" name="year" id="year" placeholder="Năm" size="10" /> Nhuận? <input type="radio" name="leap" value="1">Có <input
			type="radio" name="leap" value="0" checked="checked">Không<br />Dương lịch: <input type="number" id="revDay" name="revDay" max="31" min="1"
			placeholder="Ngày" size="10" />/<input type="number" max="12" min="1" id="revMonth"
			name="revMonth" placeholder="Tháng" size="10" /><input type="number" name="revYear" id="revYear" placeholder="Năm"
			size="10" /><br /> 
		<input type="hidden" name="command" value="doAdd" /> <input
			type="submit" />
	</form>
	<button id="convertBtn">Đổi sang Dương Lịch</button><br/>
	<a href="edit.php">Huỷ</a>
<?php
foot_scripts();
?>
</body>
