
<?php 
session_start();
?>

<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		.pc_mainContainer{
		}
		.pc_ms_right{
			background-color: #ECF0F1;
			text-align: center;
			border-radius: 5px;
			width: calc(100% - 720px);
			float: left;
			margin: 5px;
		}
		.pc_ms_right > table tr:nth-child(odd){
			background-color: white;
		}
		.pc_ms_left{
		    background-color: #ECF0F1;
		    width: 700px;
		    text-align: left;
		    border-radius: 5px;
		    float: left;
			margin: 5px;
		}
		.pc_ms_left > h2, .pc_ms_left > h4{
		    color: grey;
		    text-align: left;
		}
		.pc_ms_left > textarea{

		}
		.pc_ms_left > div{
		    padding: 10px 0 10px 0;
		    border-top: 2px solid white;

		}
		.pc_ms_left table tr td{
			border-right: 2px solid black;
			padding-right: 5px;
		}
	</style>
</head>
<body>

<div class="pc_mainContainer">
						<div class="pc_ms_left">
							<h2>Inserir dados</h3>
							<h4>Informações: Conexão - <?php echo $_SESSION['conn'][$_POST['adress']]['address']; ?> </h4>
							<div>
								<div>
									Tabela 1 <a href=""><img src="img/pmahomme/img/b_drop.png" alt=""></a> <a href=""><img src="img/pmahomme/img/b_edit.png" alt=""></a> 
								</div>
								<div>
									Tabela 1 <a href=""><img src="img/pmahomme/img/b_drop.png" alt=""></a> <a href=""><img src="img/pmahomme/img/b_edit.png" alt=""></a> 
								</div>
								<div>
									Tabela 1 <a href=""><img src="img/pmahomme/img/b_drop.png" alt=""></a> <a href=""><img src="img/pmahomme/img/b_edit.png" alt=""></a> 
								</div>
								<div>
									Tabela 1 <a href=""><img src="img/pmahomme/img/b_drop.png" alt=""></a> <a href=""><img src="img/pmahomme/img/b_edit.png" alt=""></a> 
								</div>
							</div>
							<div>
								<span>Qtd. Registros</span>
								<select name="" id="">
									<option value="1">1</option>
									<option value="10">10</option>
									<option value="50">50</option>
									<option value="100">100</option>
									<option value="500">500</option>
									<option value="1000">1.000</option>
									<option value="10000">10.000</option>
									<option value="100000">100.000</option>
								</select>
							</div>
							<div>
								<input type="checkbox">Mostrar SQL
								<input type="checkbox">Opção 2
								<input type="checkbox">Opção 3
							</div>
							<div>
								<button>Resetar</button>
								<button>Inserir</button>
							</div>
						</div>
						
						<div class="pc_ms_right">
							<h3>
								Propriedades das Tabelas
							</h3>
							<table>
								<tr>
									<td>
										11111111111aaaaaaaaaaaaaaa1111
									</td>
									<td>
										2122222222
									</td>
									<td>
										3
									</td>
									<td>
										4
									</td>
								</tr>
								<tr>
									<td>
										1
									</td>
									<td>
										2
									</td>
									<td>
										3
									</td>
									<td>
										4
									</td>
								</tr>
								<tr>
									<td>
										1
									</td>
									<td>
										2
									</td>
									<td>
										3
									</td>
									<td>
										4
									</td>
								</tr>
								<tr>
									<td>
										1
									</td>
									<td>
										2
									</td>
									<td>
										3
									</td>
									<td>
										4
									</td>
								</tr>
							</table>
					</div>
</div>

</body>
</html>

-->


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

        <script src="js/jquery.js"></script>
	<style>
		.div{
			width: 1%;
			background: -moz-linear-gradient(right, red, yellow);
		}
	</style>
</head>
<body>
	
	<div>
			<div class="div" style="background-color: red; float: left;">
				LALA
			</div>
			<div>
				85%
			</div>
	</div>
	<script>
			$(document).ready(function(){
				$(".div").animate({
			        left: '250px',
			        width: '+=800px'
			    }, 1000);
			});

	</script>
</body>
</html>
