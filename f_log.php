<?php

function f_log_insert($log_string){
	$filename = "debug_log.txt";
	$log_string = var_export ($log_string, true);
	$log_string .= "\n";
	file_put_contents($filename, $log_string, FILE_APPEND);
	chmod ($filename, 0755);
}

function f_log_delete(){
	file_put_contents("debug_log.txt", '');
}

?>