<html>
<head></head>
<body>
<?php
	function print_r2($array){
		echo '<pre>';
			print_r($array);
		echo '</pre>';
	}

	ini_set('display_errors','On');
	require '../../_common/avl.class.php';
	$AVL = new AVL;
	print_r2($AVL->get_word());
?>
</body>
</html>
