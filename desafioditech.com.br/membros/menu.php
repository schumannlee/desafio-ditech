<div id="menu">
	<span>MENU</span>
</div>
<nav>
	<a href="index.php">
		<div>Listar salas</div></a>
<?php
	if ($_SESSION['permissao'] == "admin") {
?>
	<a href="cadastro.php">
		<div>Cadastrar Sala</div></a>
	<a href="edicao.php">
		<div>Editar Sala</div></a>
<?php
	}
?>
	<a href="sair.php">
		<div>Sair</div></a>
</nav>