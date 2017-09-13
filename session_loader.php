<?php
session_start();
##

//sessions init
if(!isset($_SESSION['conn'])){
	$_SESSION['conn']['status'] = false;
	$_SESSION['conn']['banco'] = $_POST['sgbd'];
	$_SESSION['conn']['address'] = $_POST['adress'];
	$_SESSION['conn']['usr'] = $_POST['user'];
	$_SESSION['conn']['psw'] = $_POST['password'];
}
?>