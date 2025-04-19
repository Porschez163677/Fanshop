<?php
	ob_start();
	session_start();

	$Line = $_GET["Line"];
	$_SESSION["strproductcode"][$Line] = "";
	$_SESSION["strQty"][$Line] = "";

	header("location:show.php");
?>