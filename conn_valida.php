<?php
require_once 'class/conn.class.php';
session_start();
//
##Tests if connection succeeds
if(isset($_POST['id']) && $_POST['id'] == 1){
	switch ($_POST['sgbd']) {
		case 'mysql':
			$conn = new Conn($_POST['sgbd'], $_POST['adress'], $_POST['user'], $_POST['password']);
			if($conn->connStatus()){
				$_SESSION['conn'][$_POST['adress']]['status'] = true;
				$_SESSION['conn'][$_POST['adress']]['banco'] = $_POST['sgbd'];
				$_SESSION['conn'][$_POST['adress']]['address'] = $_POST['adress'];
				$_SESSION['conn'][$_POST['adress']]['usr'] = $_POST['user'];
				$_SESSION['conn'][$_POST['adress']]['psw'] = $_POST['password'];
				echo "y";
			}else{
				echo $conn->getError();
			}
			break;
		case 'oracle':
			$conn = new Conn($_POST['sgbd'], $_POST['adress'], $_POST['user'], $_POST['password']);
			if($conn->connStatus()){
				echo "y";
			}else{
				echo $conn->getError();
			}
			break;
		case 'mssql':
			echo "Ainda não configurado";
			break;
		case 'postgres':
			$conn = new Conn($_POST['sgbd'], $_POST['adress'], $_POST['user'], $_POST['password']);
			if($conn->connStatus()){
				echo "y";
			}else{
				echo $conn->getError();
			}
			break;
		case 'firebird':
			echo "Ainda não configurado";
			break;
	}
}
//
//Show databases
else if(isset($_POST['id']) && $_POST['id'] == 2){
			$conn = new Conn($_POST['sgbd'], $_POST['adress'], $_POST['user'], $_POST['password']);
			echo json_encode($conn->showDatabases($_POST['sgbd']));
}
//
//Show tables
else if(isset($_POST['id']) && isset($_POST['base']) && $_POST['id'] == 3){
	$conn = new Conn($_SESSION['conn'][$_POST['address']]['banco'], $_SESSION['conn'][$_POST['address']]['address'], $_SESSION['conn'][$_POST['address']]['usr'], $_SESSION['conn'][$_POST['address']]['psw']);
	if($conn->useDatabase($_POST['base'])){
		echo json_encode($conn->showTables());
		//echo $conn->showTables();
	}
}
//
//Massive Insert
//Tem que validar um try catch aqui, essas sessões podem estar vazias (timeout)
else if(isset($_POST['id']) && isset($_POST['base']) && isset($_POST['table']) && isset($_POST['address']) && $_POST['id'] == 4){
	$conn = new Conn('mysql', $_POST['address'], $_SESSION['conn'][$_POST['address']]['usr'], $_SESSION['conn'][$_POST['address']]['psw']);
	if($conn->useDatabase($_POST['base'])){
		//CREATE HERE INSERT INTO

		//foreach pra inserir em cada tabela
		$table = explode(",", $_POST['table']);
		die;
		foreach($table as $key){
			$conn->massiveInsert($key, $_POST['qtd']);
		}
		
	}
}
else if(isset($_POST['id']) && $_POST['id'] == 5){

}
//Disconnect
else if(isset($_POST['id']) && $_POST['id'] == 6){
	try{
		unset($_SESSION['conn']);
		echo "success";
	}catch(exception $e){
		echo "error";
	}
}else{
	header('location: index.php');
}
?>