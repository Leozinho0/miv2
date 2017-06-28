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
	var database = document.getElementById("conn_currentBase").innerText;
	var table = obj.innerText;
	var limit = document.getElementById("conn_currentQtd").value;

	ajax_loading_show();
	$.ajax({
		url: 'conn_valida.php',
		type: 'POST',
		data: 'address=127.0.0.1' + '&base=' + database + '&table=' + table + '&qtd=' + limit + '&navig=' + navig + '&id=7',
		success: function(ds){
			var arr_retorno = JSON.parse(ds);
			ajax_loading_hide();
			console.log(arr_retorno);
			$("#conn_currentTable").html(table);
			if(ds.length > 0){
				console.log(ds);
				$('#pc_mi_table').html(arr_retorno[0]);

				//Retorna o Count da query e mostra na div
				pc_upSummary();
			}else{
				alert("vazio");

			}
		}
	});
}
function pc_paginate(sentido){

	//avanca: 1
	//volta: -1
	//Final: 2
	//Primeira: -2
	var table = document.getElementById("conn_currentTable");
	pc_tableSelectQuery(table, sentido);

}
function pc_upSummary(ds_limit){
//
	var database = document.getElementById("conn_currentBase").innerText;
	var table = document.getElementById("conn_currentTable").innerText;
	var qtd = document.getElementById("conn_currentQtd").value;

	$.ajax({
		url: 'conn_valida.php',
		type: 'POST',
		data: 'address=127.0.0.1' + '&base=' + database + '&table=' + table + '&qtd=' + qtd + '&id=9',
		success: function(ds){
			if(1){
				arr_retorno = JSON.parse(ds);
				console.log(arr_retorno);

				var html_content = "[1 - 10 de " + arr_retorno + "]";
				$("#mi_tableSummary").html(html_content);
				console.log(ds);
			}

		}
	});

}
//
function pc_tableExibirQtd(qtd){
	var database = document.getElementById("conn_currentBase").innerText;
	var table = document.getElementById("conn_currentTable").innerText;

	$.ajax({
		url: 'conn_valida.php',
		type: 'POST',
		data: 'address=127.0.0.1' + '&qtd=' + qtd + '&base=' + database + '&table=' + table + '&id=8',
		success: function(ds){
			
			if(ds.length > 0){
				var count = "[1 - 10 de " + ds + "]";
				$('#pc_mi_table').html(ds);
			}else{
				alert("vazio");

			}
		}
	});
}