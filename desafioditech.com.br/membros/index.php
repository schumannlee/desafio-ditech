<?php
	include "topo.php";

// VERIFICA SE HÁ SESSÃO VÁLIDA INICIADA
	if (
		!isset($_SESSION['logado']) || 
		!isset($_SESSION['status_id']) || 
		!isset($_SESSION['permissao'])
	) {
		session_unset();
		echo "<script>location.href='$url_principal';</script>";
	}
// PERMITE ACESSO À PÁGINA
	else {
?>

	<div class="titulo-pagina">
		Controle de Uso das<br>Salas de Reunião
	</div>

	<div class="listagem">
		<div class="listagem-titulo">
			Lista de Salas para Reserva
		</div>
		<div class="listagem-exibicao">
			Nenhuma disponível no momento.
		</div>
		
	</div>

<?php
	// Conecta banco de dados
	require_once("../funcoes-php/conexao.php");

	$sql = "SELECT * FROM salas";

	include "rodape.php";

	}
?>