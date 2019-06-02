<?php
	session_start();

	if (
		!isset($_SESSION['logado']) || 
		!isset($_SESSION['status_id']) || 
		!isset($_SESSION['permissao'])
	) {
		session_unset();
		include "../funcoes-php/config.php";
		echo "<script>location.href='$url_principal';</script>";
	}
	else {

		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";

		echo "<br><a href='sair.php'>SAIR</a>";
	}
?>