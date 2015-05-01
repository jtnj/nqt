<?php
date_default_timezone_set('Asia/Saigon');
include_once ('vars.php');

$events = array();
$db_title = "";

function readF($fName) {
    global $events;
    $events = array();
    
    if (file_exists($fName)) {
        $lines = file($fName);
        
        foreach ($lines as $line) {
            list($id, $detail, $month, $day) = explode("||", $line);
            array_push($events, new Event($id, $detail, $month, $day));
        }
    }
    eventSort($events);
    
    global $db_title;
    $db_title = "";
    $lines = file($fName . "_title");
    $db_title = $lines[0];
}

function writeF($fName) {
    global $events;
    $stringData;
    $fh = fopen($fName, 'w') or die("die!");
    $format = '%s||%s||%d||%d';
    foreach ($events as & $event) {
        $stringData = sprintf($format, $event->id, $event->detail, $event->month, $event->day);
        echo $stringData;
        fwrite($fh, $stringData . "\r\n");
    }
    fclose($fh);
}

function changeTitle($db, $newTitle) {
    global $db_title;
    $db_title = $newTitle;
    $fh = fopen($db . "_title", 'w') or die("die!");
    fwrite($fh, $newTitle);
    fclose($fh);
}

function eventCompare($event1, $event2) {
    if ($event1->month < $event2->month) {
        return -1;
    } 
    elseif ($event1->month > $event2->month) {
        return 1;
    } 
    else {
        if ($event1->day < $event2->day) {
            return -1;
        } 
        elseif ($event1->day > $event2->day) {
            return 1;
        } 
        else {
            return 0;
        }
    }
}

function swapEvent($event1, $event2) {
    $tempEvent = new Event($event1->id, $event1->detail, $event1->month, $event1->day);
    
    $event1->id = $event2->id;
    $event1->detail = $event2->detail;
    $event1->month = $event2->month;
    $event1->day = $event2->day;
    
    $event2->id = $tempEvent->id;
    $event2->detail = $tempEvent->detail;
    $event2->month = $tempEvent->month;
    $event2->day = $tempEvent->day;
}

function eventSort($events) {
    while (true) {
        $complete = true;
        for ($i = 0; $i < (count($events) - 1); $i++) {
            if (eventCompare($events[$i], $events[$i + 1]) == 1) {
                swapEvent($events[$i], $events[$i + 1]);
                $complete = false;
            }
        }
        if ($complete) return;
    }
}

function addEvent(&$events, $detail, $month, $day) {
    $id = "e" . uniqid();
    $event = new Event($id, $detail, $month, $day);
    array_push($events, $event);
    eventSort($events);
}

function updateEvent($id, $detail, $month, $day) {
    global $events;
    for ($i = 0; $i < (count($events)); $i++) {
        if ($events[$i]->id == $id) {
            $events[$i]->detail = $detail;
            $events[$i]->month = $month;
            $events[$i]->day = $day;
            break;
        }
    }
    eventSort($events);
}

function getEvent($id) {
    global $events;
    foreach ($events as & $event) {
        if ($event->id == $id) {
            return $event;
        }
    }
    return null;
}

function deleteEvent($id) {
    global $events;
    for ($i = 0; $i < (count($events)); $i++) {
        if ($events[$i]->id == $id) {
            
            //if (eventCompare($events[$i], $events[count($events) - 1]) != 0){
            //  swapEvent($event[$i], $events[count($event) - 1]);
            //}
            //array_pop($events);
            array_splice($events, $i, 1);
            break;
        }
    }
    eventSort($events);
}

function session_check() {
    session_start();
    
    if (!isset($_SESSION['db'])) {
        header("Location: index.php");
    }
}
function get_header() {
    echo "<head>";
    echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
    echo "<link rel='stylesheet' type='text/css' href='style.css' />";
    echo "<script src='jquery-1.10.2.min.js'></script>";
    echo "</head>";
}

function foot_scripts() {
    echo "<script type='text/javascript' src='lunar.js' ></script>";
    echo "<script type='text/javascript' src='custom.js'></script>";
}

function getMonthEvents($month) {
    global $events;
    $mEvents = array();
    foreach ($events as $event) {
        if ($event->month == $month) {
            array_push($mEvents, $event);
        }
    }
    return $mEvents;
}

function getWDay($dNum) {
    switch ($dNum) {
        case 1:
            return "Thứ Hai";
        case 2:
            return "Thứ Ba";
        case 3:
            return "Thứ Tư";
        case 4:
            return "Thứ Năm";
        case 5:
            return "Thứ Sáu";
        case 6:
            return "Thứ Bảy";
        case 7:
            return "Chủ Nhật";
    }
}
?>