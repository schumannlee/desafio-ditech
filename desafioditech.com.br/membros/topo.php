<?php
	session_start();
	include "../funcoes-php/config.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo $jquery_lib; ?>
		<?php echo $estilos_css; ?>
		<?php echo $scripts_js; ?>
		<title><?php echo $titulo_site; ?></title>
	</head>

	<body>
		<div id="pagina">
			<div id="conteudo">