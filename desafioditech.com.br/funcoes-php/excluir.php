<?php
// VERIFICA SE POSTAGEM ESTÁ VAZIA
	if (!$_POST) {

		echo "Erro. Nada postado.";
	}
	else {
		// Conecta ao banco de dados
		require_once("conexao.php");

		$tabela = $_POST['tabela'];
		$id = $_POST['reserva_id'];

		$sql = "UPDATE reservas SET status=0 WHERE id='$id'";

		$atualizou = mysqli_query($conexao, $sql);

		if ($atualizou) {

			echo "ok";
		}
	}
?>