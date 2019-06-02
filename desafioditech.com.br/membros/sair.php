<?php
	session_start();
	session_unset();
	include "../funcoes-php/config.php";
	echo "<script>location.href='$url_principal';</script>";
?>