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
					$(obj.parentNode.getElementsByTagName('ul')[0]).append('<input type="checkbox" /> Selecionar Todas');
					for(it=0; it<arr.length; it++)
					{
						$(obj.parentNode.getElementsByTagName('ul')[0]).append("<li class='li_tables'>" + '<input type="checkbox" />' + '<a href="#" onclick="load_page_content(\'pc_massive_insert\', this.parentNode.parentNode.parentNode.title, this.parentNode.innerText); return false; "><img src="img/pmahomme/img/b_edit.png" name= "icon_table_edit" alt="" width=15px style="padding-right: 5px;" > </a>' + arr[it][0] + "</li>");
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
function js_insert(){
	ajax_insert_show();
	var d = 'sgbd=' + document.getElementById("conn_sgbd").value + '&adress=' + document.getElementById("conn_adress").value + '&user=' + document.getElementById("conn_user").value + '&password=' + document.getElementById("conn_password").value + "&base=" + document.getElementById("id_bases").value + "&table=" + document.getElementById("id_tables").value + "&qtd=" + document.getElementById("qtd_insert").value +"&id=4";
	$('.div_message').hide();
	$('.div_error').hide();
	$('#div_block').show();
	$('.div_loading').fadeIn();
	$.ajax({
		type: 'POST',
		url: 'conn_valida.php',
		data: d,
		success: function(ds){
			$('#div_block').hide();
			$('.div_loading').hide();
			var mensagem = quantidade + " registro(s) inserido(s) com sucesso!";
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
			}
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
				$('.div_error').html(ds);
				$('.div_error').fadeIn();
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
	console.log(database);
	$.ajax({
		url: 'page_content_loader.php',
		type: 'GET',
		data: 'pc_load=' + id_load + '&database=' + database + '&table=' + table,
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