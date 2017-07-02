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
###########
//
//
//
###########
if(isset($_SESSION['conn'])){
	//
	//Show databases
	if(isset($_POST['id']) && $_POST['id'] == 2){
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
				$countSelect = "";
				$navigation_variables = array('firstPage' => true, 'lastPage' => false);
				$count_variables = array('from' => 1, 'to' => '0', 'of' => '0');
				//Salva o limit inicial em sessão
				$_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] = 0;

				//Select count(*)
				$countQuery = "SELECT COUNT(*) FROM " . $tableName;
				$countSelect = $conn->select($countQuery);
				foreach($countSelect as $key){
					foreach($key as $key2){
						$countSelect = $key2;
					}
				}
				if($qtd >= $countSelect){
					$navigation_variables['lastPage'] = true;
				}

				//Setting the count variables
				$count_variables['to'] = $qtd;
				$count_variables['of'] = $countSelect;

				//Query final SELECT * FROM TABELA LIMIT
				$statement = "SELECT * FROM " . $tableName . " LIMIT " . $qtd;

				$res_fields = $conn->select_fields($database, $tableName);
				$res_rows = $conn->select($statement);
				$qtd = explode(",", $qtd);


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
				$output .= "</table>";

				$arr_retorno = array();
				$arr_retorno[] = $output;
				$arr_retorno[] = json_encode($navigation_variables);
				$arr_retorno[] = json_encode($count_variables);

				echo json_encode($arr_retorno);
				//echo json_encode($statement);
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
	//QUERY SELECT
	else if(isset($_POST['id']) && $_POST['id'] == 10){
			$conn = new Conn('mysql', $_POST['address'], $_SESSION['conn'][$_POST['address']]['usr'], $_SESSION['conn'][$_POST['address']]['psw']);
			if($conn->useDatabase($_POST['base'])){

				//Query SELECT
				$database = $_POST['base'];
				$tableName = $_POST['table'];
				$qtd = $_POST['limit'];
				$qtd_init = $_POST['limit'];
				$navig = $_POST['navig'];
				$navigation_variables = array('firstPage' => false, 'lastPage' => false);
				$count_variables = array('from' => '0', 'to' => '0', 'of' => '0');
				$countSelect = "";
				$res_fields = "";
				$res_rows = "";

				//Checa navegação...
				if(isset($_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'])){
					if($_POST['navig'] === '1'){
						$qtd = $_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] + $qtd . ', ' . $qtd;


					}else if($_POST['navig'] === '-1'){
						$qtd = ($_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] - $qtd) . ', ' . $qtd;

						if($_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] <= $qtd_init){
							$navigation_variables['firstPage'] = true;
						}
					}
					//Query final SELECT * FROM TABELA LIMIT
					$statement = "SELECT * FROM " . $tableName . " LIMIT " . $qtd;

					$res_fields = $conn->select_fields($database, $tableName);
					$res_rows = $conn->select($statement);
					$qtd = explode(",", $qtd);
					//Atualiza ultimo Limit
					$_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] = $qtd[0];

					$countQuery = "SELECT COUNT(*) FROM " . $tableName;
					$countSelect = $conn->select($countQuery);
					foreach($countSelect as $key){
						foreach($key as $key2){
							$countSelect = $key2;
						}
					}
					if(($_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'] + $qtd_init) >= $countSelect){
						$navigation_variables['lastPage'] = true;
					}
				}
				//Setting the count variables
				$count_variables['from'] = ($qtd[0] + 1);
				$count_variables['to'] = ($qtd[0] + $qtd_init);
				$count_variables['of'] = $countSelect;

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
				$output .= "</table>";

				$arr_retorno = array();
				$arr_retorno[] = $output;
				$arr_retorno[] = json_encode($navigation_variables);
				//2 -> Debug Variables
				$arr_retorno[] = json_encode($qtd_init);
				$arr_retorno[] = json_encode($count_variables);

				echo json_encode($arr_retorno);
				//echo $statement;
				//echo $_SESSION['conn'][$_POST['address']]['tableNavigLastLimit'];
			}else{
				echo "Erro ao selecionar base;";
			}
	}
}
//Exit
else{
	header('location: desconn_redir.php');
}
?>