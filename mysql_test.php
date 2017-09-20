<?php 

##MySQL SIMPLE SCRIPT TEST

$address = 'demandanet.com';
$user = 'renato2';
$pwd = 'frota2@';
try{
	if($conn_obj = new PDO("mysql:host={$address}",$user,$pwd)){
		echo "connection success!<br>";
		echo "<br>Address: " . $address . "<br>User: " . $user;
	}
}catch(PDOException $e){
	echo "<pre>";
	print_r($e->getMessage());
	echo "</pre>";
}

?>