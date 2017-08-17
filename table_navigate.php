<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

	<script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>
	<!-- JsTree -->
    <link rel="stylesheet" href="third/jstree-master/src/themes/default/style.css" />
    <script src="third/jstree-master/src/jstree.js"></script>
</head>
<body>
	<div id="container"></div>
	<script>
	$(function() {
	  $('#container').jstree({
	    'core' : {
	      'data' : {
	        "url" : "return_json_teste.php",
	        "data" : function (node) {
	          return { "id" : node.id };
	        }
	      }
	    }
	  });
	});
	</script>
</body>
</html>