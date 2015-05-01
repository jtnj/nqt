<?php
include_once ('funcs.php');
session_check();

if (isset($_POST['db_title'])) {
    changeTitle($_SESSION['db'], $_POST['db_title']);
    header("Location: edit.php");
}

readF($_SESSION['db']);
get_header();
global $events;
global $db_title;
?>
<body>

    <form action='edit.php' method='post'>
        Tiêu Đề: <input size='100' type='text' name='db_title' value='<?php
echo $db_title; ?>' />
            <input type='submit' value='Sửa' name='dbt_edit' />
            <select name="cYear" id="cYear">
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
            </select>
    </form>
    <table class="CSSTable">
        <tr>
            <td>Nội Dung</td>
            <td width="15%"></td>
            <td align="center" width="13%">Âm Lịch</td>
            <td align="center" width="20%">Dương Lịch</td>
            <td align="center" width="5%"></td>
            <td align="center" width="5%"></td>
        </tr>
        <?php
for ($i = 1; $i <= 12; $i++) {
    $mEvents = getMonthEvents($i);
    if (count($mEvents) > 0) {
        echo "<tr><td colspan='5' style='text-align: center; font-size: 16px; font-weight: bold; background-color: #ffffff;' >Tháng " . $i . "</td></tr>";
?>
        <?php
        foreach ($mEvents as $event) {
?>

        <tr id="<?php
            echo $event->id; ?>" class="event">
            <td><?php
            echo $event->detail; ?></td>
            <td style="text-align: center;" class="wDay"></td>
            <td style="text-align: center;" class="lDate"><?php
            echo $event->day . " / " . $event->month; ?></td>
            <td style="text-align: center;" class="wDate"></td>
            <td style="text-align: center;" width="5%"><form action='eEdit.php'
                    method='post'>
                    <input type='hidden' name='id' value='<?php
            echo $event->id; ?>' />
                    <input type='hidden' name='command' value='edit' /> <input
                        type="submit" class='submitLink' name='Edit' value='Sửa' />
                </form></td>
            <td style="text-align: center;" width="5%"><form action='eEdit.php'
                    method='post'>
                    <input type='hidden' name='id' value='<?php
            echo $event->id; ?>' />
                    <input type='hidden' name='command' value='del' /> <input
                        type='submit' class='submitLink' name='Delete' value='Xóa' />
                </form></td>
        </tr>
        <?php
        }
    }
}
?>
    </table>
    <br />
    <a href="eAdd.php">Thêm</a>
    <br />

    <form class="print" action="view.php" method="get">
        <input type="hidden" name="cYear" class="cYear" />
        <input type="submit" class="submitLink" value="Bản In" />
    </form>

<?php
foot_scripts();
?>
</body>
