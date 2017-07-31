<?php

require_once(dirname(__FILE__) . "/../class/conn.class.php");
echo "<br> dirname do arquivo: " . dirname(__FILE__);

$conn = new Conn("mysql", "127.0.0.1", "root", "rootroot", $instance = 'XE');

?>
<!--
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    <script src="js/jquery.js"></script>
    <script src="third/jqTree/tree.jquery.js"></script>
    <link rel="stylesheet" href="third/jqTree/jqtree.css">
</head>
<body>
	<div id="tree1"></div>
	<script>
		var data = [
		    {
		        name: 'node1',
		        children: [
		            { name: 'child1' },
		            { name: 'child2' }
		        ]
		    },
		    {
		        name: 'node2',
		        children: [
		            { name: 'child3' }
		        ]
		    }
		];
		$(function() {
		    $('#tree1').tree({
		        data: data
		    });
		});
	</script>
</body>
</html>
-->