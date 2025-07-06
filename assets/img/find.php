<?php
if($_GET['t']==1){
$start = strtotime(date("Y-m-d H:00",strtotime('+2 hours')));
$end = strtotime(date("Y-m-d H:00",strtotime('+24 hours')));
if($_GET)
{
	$start = $_GET['start']  ? strtotime($_GET['start']) : $start ;
	$end = $_GET['end'] ? strtotime($_GET['end']) : $end;
}
header("location:/search/cars-rental-Delhi-NCR?city=4&start=$start&end=$end");exit;
}


if($_GET['t']==2){
$start = strtotime(date("Y-m-d H:00",strtotime('+2 hours')));

if($_GET)
{
	$start = $_GET['start']  ? $_GET['start'] : $start ;
}
header("location:/monthly?city=&start=$start&months=1");exit;
}


?>