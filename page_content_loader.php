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
			echo '<div class="pc_ms_left pc_default_container "><h3>Inserir Dados</h3><h4><a href="" >'.$_SESSION['conn']['127.0.0.1']['address'] . '</a> ' . ' > ' . '<a href=""> '. $_GET['database'] . '</a>' . ' > ' . '<a href="">' . $_GET['table'] .'</a></h4> <div class="pc_ms_left_listTables"> <div> Tabela 1 <a href=""><img src="img/pmahomme/img/b_drop.png" alt=""></a> <a href=""><img src="img/pmahomme/img/b_edit.png" alt=""></a> </div> <div> Tabela 2 <a href=""><img src="img/pmahomme/img/b_drop.png" alt=""></a> <a href=""><img src="img/pmahomme/img/b_edit.png" alt=""></a> </div> <div> Tabela 3 <a href=""><img src="img/pmahomme/img/b_drop.png" alt=""></a> <a href=""><img src="img/pmahomme/img/b_edit.png" alt=""></a> </div> </div> <div> <span>Qtd. Registros</span> <select name="" id=""> <option value="1">1</option> <option value="10">10</option> <option value="50">50</option> <option value="100">100</option> <option value="500">500</option> <option value="1000">1.000</option> <option value="10000">10.000</option> <option value="100000">100.000</option> </select> </div> <div> <input type="checkbox">Mostrar SQL <input type="checkbox">Opção 2 <input type="checkbox">Opção 3 </div> <div> <button>Resetar</button> <button onclick="js_insert();">Inserir</button> </div> <div class="div_message"> </div> </div> </div> <div class="pc_ms_right pc_default_container"> <h3> Propriedades da Tabela </h3> <div> Nome da tabela <br> SQL atual </div> <div> <table> <tr> <td> A </td> </tr> </table> </div> <div> menu navegação </div> </div>';
			break;
		}

		default:
		echo "nada";
		break;
	}
}	
//
?>