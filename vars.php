<?php

class Event
{
	public $id = "";
	public $detail = "";
	public $month = 0;
	public $day = 0;
	
	public function __construct($id, $detail, $month, $day){
		$this->detail = $detail;
		$this->month = intval($month);
		$this->day = intval($day);
		$this->id = $id;
	}
}
?>