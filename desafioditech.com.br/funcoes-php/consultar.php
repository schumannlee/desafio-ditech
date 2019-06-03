<?php
	session_start();
// VERIFICA SE POSTAGEM ESTÁ VAZIA
	if (!$_POST) {

		echo "Erro. Nada postado.";
	}
	else {
		// Inclui configuração base
		include "config.php";

		// Conecta ao banco de dados
		require_once("conexao.php");

		$tabela = $_POST['tabela'];

	// VERIFICA TABELA ALVO
		if ($tabela == "usuarios") {

			// Inicializa variáves para inserção
			$login = $_POST['login'];
			$senha = $_POST['senha'];

			// Monta SQL da inserção
			$sql = "
				SELECT 
					* 
				FROM 
					usuarios 
				WHERE 
					login = '$login' 
				AND 
					senha = '$senha'
			";
			// Executa consulta SQL
			$consulta = mysqli_query($conexao, $sql);

			// Obtém total de resultados
			$total = mysqli_num_rows($consulta);

			// Condição para fim de execução
			if ($total == 0) {
				
				echo "0@Login ou senha não confere.";
				die;
			}

			// Obtém resultado da consulta
			$resultado = mysqli_fetch_assoc($consulta);

			// Inicializa variáveis de sessão
			$_SESSION['logado'] 	= $resultado['login'];
			$_SESSION['logado_id'] 	= $resultado['id'];
			$_SESSION['status_id'] 	= $resultado['status_id'];
			$_SESSION['permissao'] 	= $resultado['permissao'];

			echo "1@$url_principal"."membros";
		}
		// Fecha conexão
		mysqli_close($conexao);
	}
?>