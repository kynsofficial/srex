<?php
ob_start();
date_default_timezone_set("Africa/Lagos");

$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'get_parcel_heistory'){
	$get = $crud->get_parcel_heistory();
	if($get)
		echo $get;
}

if($action == 'get_report'){
	$get = $crud->get_report();
	if($get)
		echo $get;
}
ob_end_flush();
?>
