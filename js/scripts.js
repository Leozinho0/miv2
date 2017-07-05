function js_listBases(){
	var d = 'sgbd=' + document.getElementById("conn_sgbd").value + '&adress=' + document.getElementById("conn_adress").value + '&user=' + document.getElementById("conn_user").value + '&password=' + document.getElementById("conn_password").value + "&id=2";
	$.ajax({
		type: 'POST',
		url: 'conn_valida.php',
		data: d,
		success: function(ds){
			arr = JSON.parse(ds);

			$("#id_bases").html('');

			$("#id_bases").append("<option value=''></option>");
			for(it=0; it<arr.length; it++)
			{
				$("#id_bases").append("<option value='"+ arr[ it ].Database +"'>"+ arr[ it ].Database +"</option>");
			}

			$('#div_dados').show();
			$('#div_bases').show();
		}
	});
}
//
function js_listTables(obj){
	//check if already has li
	if(obj.parentNode.getElementsByTagName('ul').length > 0){
		if(obj.parentNode.getElementsByTagName('ul')[0].style.display != "none"){
			obj.parentNode.getElementsByTagName('ul')[0].style.display = "none";
		}else{
			obj.parentNode.getElementsByTagName('ul')[0].style.display = "list-item";
		}
	}else{
		var base = obj.parentNode.innerText;
		var	address = document.getElementById("connection_address").innerText;
		var d = "base=" + base + "&id=3" + "&address=" + address;
		$.ajax({
			type: 'POST',
			url: 'conn_valida.php',
			data: d,
			success: function(ds){
				try{
					arr = JSON.parse(ds);
					$(obj.parentNode).append("<ul class='ul_tables'>");
					$(obj.parentNode.getElementsByTagName('ul')[0]).append('<input type="checkbox" title="checkbox_selectAll" onclick="toggle_checkboxAll(this);"/> Selecionar Todas');
					for(it=0; it<arr.length; it++)
					{
						$(obj.parentNode.getElementsByTagName('ul')[0]).append("<li class='li_tables'>" + '<input type="checkbox" />' + '<a href="#" onclick="load_page_content(\'pc_massive_insert\', this.parentNode.parentNode.parentNode.title, this); return false; "><img src="img/pmahomme/img/b_edit.png" name= "icon_table_edit" alt="" width=15px style="padding-right: 5px;" > </a>' + arr[it][0] + "</li>");
					}
					$(obj.parentNode).append("</ul>");
					$('#div_tabelas').show();
				}catch(e){
					//window.location = "http://www.google.com.br";
					console.log(ds);
				}
			}
		});
	}
}
function js_insert(obj){
	//var address = obj.parentNode.parentNode.getElementById("conn_address").innerText;
	var address = document.getElementById("conn_address").innerText;
	var base = document.getElementById("conn_currentBase").innerText;
	//
	var table = [];
	var tableObj = obj.parentNode.parentNode.getElementsByClassName('mi_tables');
	for(var i = 0; i < tableObj.length; i++){
		table.push(tableObj[i].innerText);
	}
	//
	var qtd = document.getElementById("mi_qtd").value;

	//ajax_insert_show();
	//var d = 'sgbd=' + document.getElementById("conn_sgbd").value + '&adress=' + document.getElementById("conn_adress").value + '&user=' + document.getElementById("conn_user").value + '&password=' + document.getElementById("conn_password").value + "&base=" + document.getElementById("id_bases").value + "&table=" + document.getElementById("id_tables").value + "&qtd=" + document.getElementById("qtd_insert").value +"&id=4";
	
	$('.div_message').hide();
	$('.div_error').hide();
	$('#div_block').show();
	$('.div_loading').fadeIn();

	var dataset = "address=" + address+ "&base=" + base + "&table=" + table + "&qtd=" + qtd + "&id=4";

	$.ajax({
		type: 'POST',
		url: 'conn_valida.php',
		data: dataset,
		success: function(ds){
			/*
			$('#div_block').hide();
			$('.div_loading').hide();
			var mensagem =  "registro(s) inserido(s) com sucesso!";
			//1.Ds retorna um objeto JSON. Fazer um JSON.parse
			//2.Verificação do retorno ds. Pode ser um erro ds.[0] -> erro!
			
			try{
				arr = JSON.parse(ds);
				//if->Modo Debug
				//else->Modo Normal
				//if->Sem erro->Mostra a query
				//else->Erro->Mostra o info do erro
				if(arr[0] == ''){
					if(debug){
						$('.div_message').html(arr);
						$('.div_message').fadeIn();
					}else{
						$('.div_message').html(mensagem);
						$('.div_message').fadeIn();
					}	
				}else if(arr[0] == 'ERRO!<br>'){
					$('.div_error').html(arr[1]);
					$('.div_error').fadeIn();
				}
			}catch(e){
				$('.div_error').html(ds);
				$('.div_error').fadeIn();
			}*/alert(ds);
		}
	});
}
//
function js_conn(){
	var address = document.getElementById("conn_adress").value;
	var d = 'sgbd=' + $('#conn_sgbd option:selected').val() + '&adress=' + address + '&user=' + document.getElementById("conn_user").value + '&password=' + document.getElementById("conn_password").value + "&id=1";
	$.ajax({
		type: 'POST',
		url: 'conn_valida.php',
		data: d,
		success: function(ds){
			if(ds == "y"){
				var home_redirect = "home.php?address=" + address;
				window.location = home_redirect;
			}else {
				$('.box_error').html(ds);
				$('.box_error').fadeIn();
			}
		}
	});
}

//TORNAR ESSAS FUNÇÕES UMA SÓ, POSTERIORMENTE
//Fiz assim pq tava com preguiça
function conn_disable(class_name_remove, class_name_add){
	//Desativar botão 'conectar' trocando classes:
	$('#button_connect').removeClass(class_name_remove).addClass(class_name_add);
	//destaivar elementos da div:
	$('#div_conexao :input').attr('disabled', true);
}
function insert_enable(class_name_remove, class_name_add){
	//Desativar botão 'conectar' trocando classes:
	$('#button_insert').removeClass(class_name_remove).addClass(class_name_add);
}


//

function hide_icon(obj){
	if(obj.name == 'icon_plus'){
		obj.style.display = "none";
		obj.parentNode.getElementsByTagName('img')[1].style.display = "inline";
	}else if(obj.name == 'icon_minus'){
		obj.style.display = "none";
		obj.parentNode.getElementsByTagName('img')[0].style.display = "inline";
	}
}
//
function disconnect(){
	d = 'id=6';
	$.ajax({
		type: 'POST',
		url: 'conn_valida.php',
		data: d,
		success: function(ds){
			if(ds === "success"){
				window.location = 'index.php';
			}else if(ds === "error"){
				alert("Internal error - Could not disconnect;");
			}
		}
	});
}

//Test colapsing
function div_RightToLeftCollapse(obj){
	$(obj).toggle();
}
//

/*
function load_page_content(id_content){
	$(id_content).show();
}
*/
function load_page_content(id_load, database, table){
	ajax_loading_show();

	//GetArrayWithTablesNames
	var tableName = [];
	table = table.parentNode.parentNode.getElementsByTagName('li');
	for(var i = 0; i < table.length; i++){
		if($(table[i]).children('input').prop("checked")){
			tableName.push(table[i].innerText);
		}
	}

	$.ajax({
		url: 'page_content_loader.php',
		type: 'GET',
		data: 'pc_load=' + id_load + '&database=' + database + '&table=' + tableName,
		success: function(ds){
			$('#body_right_container').html(ds);
			ajax_loading_hide();
		}
	});
	
}

function ajax_loading_show(){
	$('.ajax_main_loading').fadeIn();
}

function ajax_loading_hide(){
	$('.ajax_main_loading').hide();
}

function ajax_insert_show(){
	$('.div_message').hide();
	$('.div_error').hide();
	$('.ajax_main_loading').fadeIn();
}
//EventListenersJquery
function toggle_checkboxAll(checkbox){
	if(checkbox.checked){
		$(checkbox).parent().children('li').children('input').prop("checked", true);
	}else{
		$(checkbox).parent().children('li').children('input').prop("checked", false);
	}
}

//Slider - Incompleto

$(document).ready(function(){
	$('.slider').on('mousedown',function(e){
		$('.column').on('mousemove',function(e){
			diff = $('.slider').offset().top + 5 - e.pageY ;
			$('.top').height($('.top').height()-diff);
			$('.bot').height($('.bot').height()+diff);
		});
	});
	$('.column').on('mouseup',function(){
		$('.column').off('mousemove');
	});
});
//
function pc_tableSelectQuery(obj, navig){
//
	if(obj){
		var table = obj.innerText;
	}else{
		var table = document.getElementById("conn_currentTable").innerText;
	}
	var database = document.getElementById("conn_currentBase").innerText;
	var limit = document.getElementById("conn_currentQtd").value;

	//ajax_loading_show();
	$.ajax({
		url: 'conn_valida.php',
		type: 'POST',
		data: 'address=127.0.0.1' + '&base=' + database + '&table=' + table + '&qtd=' + limit + '&navig=' + navig + '&id=7',
		success: function(ds){
			ajax_loading_hide();

			var arr_retorno = JSON.parse(ds);
			var html = arr_retorno[0];
			var navigation_variables = JSON.parse(arr_retorno[1]);
			var count_variables = JSON.parse(arr_retorno[2]);
			var count_html = "[" + count_variables.from + " - " + count_variables.to + " de " + count_variables.of + "]";
			var navig_qtdPage_html = "&ensp;";

			//APAGAR - MONTAGEM DA QUANTIDADE DE PÁGINAS
			//7 é a qt máxima q eu quero exibir no span 3 1 3
			for(var i = 1; i <= navigation_variables.qtdPage; i++){
				if(i <= 7){
					if(i == 1){
						navig_qtdPage_html += "<a href='' class='navigate_numPage_atual'>" + i + "</a>";
					}else{
						navig_qtdPage_html += "<a href='' class='navigate_numPage'>" + i + "</a>";
					}
				}
			}
			$('#navigate_qtdPage').html(navig_qtdPage_html);
			//

			$("#conn_currentTable").html(table);
			if(ds.length > 0){
				$('#pc_mi_table').html(html);
				if(count_variables.of === 0){
					//Cuspir os erros no select da tabela ou
					// mensagem de sem registro aqui nessa div
					var empty_table = "<div>Sem registros</div>";
					$('#pc_table_errors').html(empty_table).show();
				}else if(count_variables.of > 0){
					$('#pc_table_errors').hide();
				}else{
					$('#pc_table_errors').html("Erro interno ao recuperar dados.").show();
				}
				$('#mi_tableSummary').html(count_html);

				if(navigation_variables.firstPage === true && navigation_variables.lastPage === false){
					mi_table_navigToggle('first');
				}else if(navigation_variables.firstPage === false && navigation_variables.lastPage === true){
					mi_table_navigToggle('last');
				}else if(navigation_variables.firstPage === true && navigation_variables.lastPage === true){
					mi_table_navigToggle('both');
				}else{
					mi_table_navigToggle('all');
				}
			}else{
				alert("vazio");

			}
		}
	});
}
function mi_navigate(navig){

	//avanca: 1
	//volta: -1
	//Final: 2
	//Primeira: -2

	//Travar navegação
	var elemento_parent = $('.pc_default_container_navigation')[0];
	travarNavegação(elemento_parent, 1);
	//

	//FirstPage
	if(navig === -2){
		pc_tableSelectQuery();
		return;
	}

	var database = document.getElementById("conn_currentBase").innerText;
	var table = document.getElementById("conn_currentTable").innerText;
	var limit = document.getElementById("conn_currentQtd").value;

	$.ajax({
		url: 'conn_valida.php',
		type: 'POST',
		data: 'address=127.0.0.1' + '&base=' + database + '&table=' + table + '&limit=' + limit + '&navig=' + navig + '&id=10',
		success: function(ds){

			var arr_retorno = JSON.parse(ds);
			var html = arr_retorno[0];
			var navigation_variables = JSON.parse(arr_retorno[1]);
			var navig_qtdPage_html = "";
			var debug_variables = JSON.parse(arr_retorno[2]);
			var count_variables = JSON.parse(arr_retorno[3]);
			console.log(count_variables);
			var count_html = "[" + count_variables.from + " - " + count_variables.to + " de " + count_variables.of + "]";

			console.log("Ultimo limit " + debug_variables);

			//Montar a navegação da pagina atual
			//Tá uma loucura esse código - AMADOR
			//Garanto que qualquer um reduz isso a 5 linhas
			var pagina_atual = count_variables.to/limit;
			console.log(pagina_atual);
			if(pagina_atual > 4 && ((pagina_atual+2) < navigation_variables.qtdPage) && navigation_variables.qtdPage > 7){
				for(var i = -3; i <= 3; i++){
					if(i == -1){
						navig_qtdPage_html += "<a href='' class='navigate_numPage_atual'>" + (pagina_atual+i) + "</a>";
					}else{
						navig_qtdPage_html += "<a href=''>" + (pagina_atual+i) + "</a>";
					}			
				}
				$('#navigate_qtdPage').html(navig_qtdPage_html);
			}
			//Navegarção do numero de paginas
			if(navig === 1){
				var numPage_atual = document.getElementsByClassName('navigate_numPage_atual')[0];
				$(numPage_atual).removeClass('navigate_numPage_atual').addClass('navigate_numPage');
				$(numPage_atual).next().removeClass("navigate_numPage").addClass('navigate_numPage_atual');
			}else if(navig === -1){
				var numPage_atual = document.getElementsByClassName('navigate_numPage_atual')[0];
				$(numPage_atual).removeClass('navigate_numPage_atual').addClass('navigate_numPage');
				$(numPage_atual).prev().removeClass("navigate_numPage").addClass('navigate_numPage_atual');
			}
			//

			$("#conn_currentTable").html(table);
			if(ds.length > 0){
				$('#pc_mi_table').html(html);
				$('#mi_tableSummary').html(count_html);
				if(navigation_variables.firstPage === true && navigation_variables.lastPage === false){
					mi_table_navigToggle('first');
				}else if(navigation_variables.firstPage === false && navigation_variables.lastPage === true){
					mi_table_navigToggle('last');
				}else{
					mi_table_navigToggle('none');
				}
			}else{
				alert("vazio");

			}
			//Destravar navegaçao do span dos numeros das páginas
			var elemento_parent = $('#navigate_qtdPage');
			travarNavegação(elemento_parent, 0);
		}
	});
}
//
function travarNavegação(elemento_parent, opcao){
	//opcao 1 - trava
	//opcao 0 - destrava
	if(opcao === 1){
		$(elemento_parent).find("a").removeClass('navig_enabled').addClass('navig_disabled');
		//$(elemento_parent).find("a").css("pointer-events", "none");
	}else if(opcao === 0){
		//$(elemento_parent).find("a").css("pointer-events", "all" );
		$(elemento_parent).find("a").removeClass('navig_disabled').addClass('navig_enabled');
	}
}
//
function mi_table_navigToggle(navigPos){
	if(navigPos === 'first'){
		$('#navigate_prev').addClass('navig_disabled').removeClass('navig_enabled');
		$('#navigate_first').addClass('navig_disabled').removeClass('navig_enabled');
		$('#navigate_next').addClass('navig_enabled').removeClass('navig_disabled');
		$('#navigate_last').addClass('navig_enabled').removeClass('navig_disabled');
	}else if(navigPos === 'last'){
		$('#navigate_next').addClass('navig_disabled').removeClass('navig_enabled');
		$('#navigate_last').addClass('navig_disabled').removeClass('navig_enabled');
		$('#navigate_prev').addClass('navig_enabled').removeClass('navig_disabled');
		$('#navigate_first').addClass('navig_enabled').removeClass('navig_disabled');
	}else if(navigPos === 'both'){
		$('#navigate_next').addClass('navig_disabled').removeClass('navig_enabled');
		$('#navigate_last').addClass('navig_disabled').removeClass('navig_enabled');
		$('#navigate_prev').addClass('navig_disabled').removeClass('navig_enabled');
		$('#navigate_first').addClass('navig_disabled').removeClass('navig_enabled');
	}else{
		$('#navigate_prev').addClass('navig_enabled').removeClass('navig_disabled');
		$('#navigate_first').addClass('navig_enabled').removeClass('navig_disabled');
		$('#navigate_next').addClass('navig_enabled').removeClass('navig_disabled');
		$('#navigate_last').addClass('navig_enabled').removeClass('navig_disabled');
	}
}
//