<?php
//
sleep(1);
session_start();


if(isset($_POST['pc_load'])){
	switch ($_POST['pc_load']) {
		case 'pc_sql':
		{
			echo '<div class="pc_mainContainer"> <div class="pc_sql"> <h2>Tittle</h3> <h4>Sub - Banco - Base - Tabela</h4> <textarea name="" id="" cols="90" rows="10"> </textarea> <div> <button>Limpar</button> <button>Inserir</button> </div> </div> </div>'; 
			break;
		}
		case 'pc_massive_insert':
		{
			$output = '<div class="pc_ms_left pc_default_container "> <h3 class="pc_default_container_title">Inserir Dados</h3> <h4><a href="" id="conn_address" >'.$_SESSION['conn']['127.0.0.1']['address'] . '</a> ' . ' > ' . '<a href="" id="conn_currentBase"> '. $_POST['database'] . '</a></h4> <div class="pc_ms_left_listTables"> '; $tables = explode(",", $_POST['table']); foreach($tables as $key){$output = $output . '<div> <a href="" onclick="mi_removeTable(this); return false;"><img src="img/pmahomme/img/b_drop.png" alt=""></a> <a href=""></a><a href="" onclick="pc_tableSelectQuery(this); return false;" class="mi_tables">' . $key . '</a> </div> '; } $output = $output . '</div> <div> <span>Quantidade de Registros</span> <select name="" id="mi_qtd"> <option value="1">1</option> <option value="10">10</option> <option value="50">50</option> <option value="100">100</option> <option value="500">500</option> <option value="1000">1.000</option> <option value="10000">10.000</option> <option value="100000">100.000</option> </select> </div> <div> <input type="checkbox">Mostrar SQL </div> <div> <button>Resetar</button> <button onclick="js_insert(this);">Inserir</button> </div> <div class="div_message"> </div> </div> </div> 

			<div class="pc_ms_right pc_default_container"> 
			<h3 class="pc_default_container_title"> Propriedades da Tabela </h3>
			<h4 id="conn_currentTable"></h4>
			<div class="pc_default_container_table"> 
			<table id="pc_mi_table"> </table>
			<div id="pc_table_errors"></div>
			</div>


			<div class="pc_default_container_navigation"> <div>Exibir <select name="" id="conn_currentQtd" onchange="pc_tableSelectQuery();" ><option value="10">10</option><option value="50">50</option><option value="100">100</option></select></div> <div><a href="" id="navigate_first" class="navig_disabled" onclick="mi_navigate(-2); return false;"> <img src="img/pmahomme/img/bd_firstpage.png" alt=""></a> <a href="" id="navigate_prev" class="navig_disabled" onclick="mi_navigate(-1); return false;"> <img src="img/pmahomme/img/bd_prevpage.png" alt=""></a> <span id="navigate_qtdPage"> </span> <a href="" id="navigate_next" class="navig_disabled" onclick="mi_navigate(1); return false;"> <img src="img/pmahomme/img/bd_nextpage.png" alt=""></a> <a href="" id="navigate_last" class="navig_disabled" onclick="mi_navigate(2); return false;"> <img src="img/pmahomme/img/bd_lastpage.png" alt=""></a> </div> <div id="mi_tableSummary">[0 - 0 de 0]</div> </div> 

			</div> </div> ';
			
			echo $output;
			break;
		}

		default:
		echo "nada";
		break;
	}
}	
//
?>