<?php
include_once ('funcs.php');
session_check();

if (!file_exists($_SESSION['db'])) {
    header("Location: index.php");
}

if (isset($_GET['cYear'])) {
    $_SESSION['cYear'] = $_GET['cYear'];
} else {
    $_SESSION['cYear'] = date("Y");
}

get_header();
?>
<body>
    <input type="hidden" id="cYear" value="<?php echo $_SESSION['cYear']; ?>" />
    <table class="CSSTable">
        <tr>
            <td>Nội Dung</td>
            <td width="15%"></td>
            <td align="center" width='13%' >Âm Lịch</td>
            <td align="center" width='20%'>Dương Lịch</td>
        </tr>
        <?php
readF($_SESSION['db']);

global $events;
global $db_title;
echo "<div align='center'><h2>" . $db_title . " " . $_SESSION['cYear'] . "</h2></div>";
for ($i = 1; $i <= 12; $i++) {
    $mEvents = getMonthEvents($i);
    if (count($mEvents) > 0) {
        echo "<tr><td colspan='5' style='text-align: center; font-size: 16px; font-weight: bold; background-color: #ffffff;' >Tháng " . $i . "</td></tr>";
?>
            <?php
        foreach ($mEvents as $event) {
?>

            <tr class="event">
                <td><?php
            echo $event->detail; ?></td>
                <td style="text-align: center;" class="wDay"></td>
                <td style="text-align: center;" class="lDate"><?php
            echo $event->day; ?> / <?php
            echo $event->month; ?>
                </td>
                <td style="text-align: center;" class="wDate"></td>
            </tr>
            <?php
        }
    }
}
?>
        </table>
<?php
foot_scripts(); ?>
</body>
