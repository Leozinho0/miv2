<?php

//includes
require_once 'class/conn.class.php';
//require_once 'session_loader.php';
session_start();

//Usar ISSET para checkar sessão
if(1){

}else{
	header('location: desconn_redir.php');
}
?>