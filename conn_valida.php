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
}
//
//QUERY SELECT
else if(isset($_POST['id']) && $_POST['id'] == 7){
		$conn = new Conn('mysql', $_POST['address'], $_SESSION['conn'][$_POST['address']]['usr'], $_SESSION['conn'][$_POST['address']]['psw']);
		if($conn->useDatabase($_POST['base'])){

			//Query SELECT
			$database = $_POST['base'];
			$tableName = $_POST['table'];
			$qtd = $_POST['qtd'];

			//Checka navegação... Tá uma bagunça, mostra como eu sou organizado ¬¬'
			if(isset($_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'])){
				if($_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] > '0'){
					if($_POST['navig'] === '1'){
						$qtd = $_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] + $qtd . ', ' . $qtd;
					}else if($_POST['navig'] === '-1'){
						$qtd = $_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] - $qtd . ', ' . $qtd;
						//$qtd = 0, 10 
					}
				}

			}

			//Query final SELECT * FROM TABELA LIMIT
			$statement = "SELECT * FROM " . $tableName . " LIMIT " . $qtd;

			$res_fields = $conn->select_fields($statement, $database, $tableName);
			$res_rows = $conn->select($statement);
			$qtd = explode(",", $qtd);
			//S_SESSION = 0
			$_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] = $qtd[0];


			$output = "<table>";
			//Table Fields (collumns)
			if(!empty($res_fields)){
				$output .= '<tr class="table_fields">';
				foreach($res_fields as $key){
					foreach($key as $key2){
						$output .= "<td>" .$key2. "</td>";
					}
				}
				$output .= "</tr>";
			}
			//Table rows
			if(!empty($res_rows)){
				foreach($res_rows as $key){
					$output .= "<tr>";
					foreach($key as $key2){
						$output .= "<td>" .$key2. "</td>";
					}
					$output .= "</tr>";
				}
			}
			echo $output . "</table>";
			//echo $statement;
			//var_dump($_SESSION['conn'][$_POST['address']]['tableNavigLastLimit']);
		}else{
			echo "Erro ao selecionar base;";
		}
}

else if(isset($_POST['id']) && $_POST['id'] == 8 && isset($_POST['qtd'])){
		$conn = new Conn('mysql', $_POST['address'], $_SESSION['conn'][$_POST['address']]['usr'], $_SESSION['conn'][$_POST['address']]['psw']);
		
		$qtd =$_POST['qtd'];
		$database = $_POST['base'];
		$tableName = $_POST['table'];

		if(!empty($database) && !empty($tableName)){
			if($conn->useDatabase($database)){

				$statement = "SELECT * FROM " . $tableName . " LIMIT " . $qtd;
				$res_fields = $conn->select_fields($statement, $database, $tableName);
				$res_rows = $conn->select($statement);

				$output = "<table>";
				//Table Fields (collumns)
				if(!empty($res_fields)){
					$output .= '<tr class="table_fields">';
					foreach($res_fields as $key){
						foreach($key as $key2){
							$output .= "<td>" .$key2. "</td>";
						}
					}
					$output .= "</tr>";
				}
				//Table rows
				if(!empty($res_rows)){
					foreach($res_rows as $key){
						$output .= "<tr>";
						foreach($key as $key2){
							$output .= "<td>" .$key2. "</td>";
						}
						$output .= "</tr>";
					}
				}
				echo $output . "</table>";

			}
		}else{
			echo "Selecione uma tabela";
		}
}
else if(isset($_POST['id']) && isset($_POST['qtd']) && $_POST['id'] == 9){
		$conn = new Conn('mysql', $_POST['address'], $_SESSION['conn'][$_POST['address']]['usr'], $_SESSION['conn'][$_POST['address']]['psw']);
		
		$qtd =$_POST['qtd'];
		$database = $_POST['base'];
		$tableName = $_POST['table'];
		$countSelect = "SELECT COUNT(*) FROM " . $tableName;

		if(!empty($database) && !empty($tableName)){
			if($conn->useDatabase($database)){

				//$statement = "SELECT * FROM " . $tableName . " LIMIT " . $qtd;
				//$res_fields = $conn->select_fields($statement, $database, $tableName);
				$res_count = $conn->select($countSelect);
				/*
				$output = "<table>";
				//Table Fields (collumns)
				if(!empty($res_fields)){
					$output .= '<tr class="table_fields">';
					foreach($res_fields as $key){
						foreach($key as $key2){
							$output .= "<td>" .$key2. "</td>";
						}
					}
					$output .= "</tr>";
				}
				//Table rows
				if(!empty($res_rows)){
					foreach($res_rows as $key){
						$output .= "<tr>";
						foreach($key as $key2){
							$output .= "<td>" .$key2. "</td>";
						}
						$output .= "</tr>";
					}
				}
				//echo $output . "</table>";
				*/
				foreach ($res_count as $key){
					foreach($key as $key2){
						echo $key2;
						//echo $countSelect;
					}
				}

			}
		}else{
			echo "Selecione uma tabela";
		}
}
//Exit
else{
	header('location: index.php');
}
?>