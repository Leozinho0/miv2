<?php
//
sleep(1);
session_start();

if(isset($_GET['pc_load'])){
	switch ($_GET['pc_load']) {
		case 'pc_sql':
		{
			echo '<div class="pc_mainContainer"> <div class="pc_sql"> <h2>Tittle</h3> <h4>Sub - Banco - Base - Tabela</h4> <textarea name="" id="" cols="90" rows="10"> </textarea> <div> <button>Limpar</button> <button>Inserir</button> </div> </div> </div>'; 
			break;
		}
		case 'pc_massive_insert':
		{
			$output = '<div class="pc_ms_left pc_default_container "> <h3 class="pc_default_container_title">Inserir Dados</h3> <h4><a href="" id="conn_address" >'.$_SESSION['conn']['127.0.0.1']['address'] . '</a> ' . ' > ' . '<a href="" id="conn_currentBase"> '. $_GET['database'] . '</a></h4> <div class="pc_ms_left_listTables"> '; $tables = explode(",", $_GET['table']); foreach($tables as $key){$output = $output . '<div> <a href=""><img src="img/pmahomme/img/b_drop.png" alt=""></a> <a href=""></a><a href="" onclick="pc_tableSelectQuery(this); pc_tableNavigate(); return false;" class="mi_tables">' . $key . '</a> </div> '; } $output = $output . '</div> <div> <span>Quantidade de Registros</span> <select name="" id="mi_qtd"> <option value="1">1</option> <option value="10">10</option> <option value="50">50</option> <option value="100">100</option> <option value="500">500</option> <option value="1000">1.000</option> <option value="10000">10.000</option> <option value="100000">100.000</option> </select> </div> <div> <input type="checkbox">Mostrar SQL </div> <div> <button>Resetar</button> <button onclick="js_insert(this);">Inserir</button> </div> <div class="div_message"> </div> </div> </div> 

			<div class="pc_ms_right pc_default_container"> 
			<h3 class="pc_default_container_title"> Propriedades da Tabela </h3>
			<h4 id="conn_currentTable"> Tabela1 </h4>
			<div class="pc_default_container_table"> 
			<table id="pc_mi_table"> </table> 
			</div> 


			<div class="pc_default_container_navigation"> <div>Exibir <select name="" id="conn_currentQtd" onchange="pc_tableExibirQtd(this.value);" ><option value="10">10</option><option value="50">50</option><option value="100">100</option></select></div> <div><a href=""> <img src="img/pmahomme/img/bd_firstpage.png" alt=""></a> <a href=""> <img src="img/pmahomme/img/bd_prevpage.png" alt=""></a> <a href=""> <img src="img/pmahomme/img/bd_nextpage.png" alt=""></a> <a href=""> <img src="img/pmahomme/img/bd_lastpage.png" alt=""></a> </div> <div id="mi_tableNavigCount">[1 - 10 de 0]</div> </div> 

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