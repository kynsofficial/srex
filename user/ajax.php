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

if($action == 'shipping_prepare'){
	$get = $crud->shipping_prepare();
	if($get)
		echo $get;
}

if($action == 'get_user_balance'){
	$get = $crud->get_user_balance();
	if($get)
		echo $get;
}

if($action == 'get_states'){
	$get = $crud->get_states();
	if($get)
		echo $get;
}

if($action == 'get_delivery_options'){
	$get = $crud->get_delivery_options();
	if($get)
		echo $get;
}

if($action == 'get_product_category'){
	$get = $crud->get_product_category();
	if($get)
		echo $get;
}

ob_end_flush();
?>