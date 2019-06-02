<?php
// VERIFICA SE POSTAGEM ESTÁ VAZIA
	if (!$_GET) {

		echo "Erro. URL inválida.";
	}
	else {
		// Inclui configuração base
		include "config.php";

		// Conecta ao banco de dados
		require_once("conexao.php");

		// Inicializa variáves para inserção
		$login = $_GET['login'];

		// Monta SQL da consulta
		$sql = "
			SELECT 
				status_id  
			FROM 
				usuarios
			WHERE 
				login = '$login'
		";
		// Executa consulta SQL
		$consulta = mysqli_query($conexao, $sql);

		// Obtém total de resultados
		$total = mysqli_num_rows($consulta);

		// Condição para fim de execução
		if ($total == 0) {
			# code...
			die;
		}

		// Obtém resultado da consulta
		$resultado = mysqli_fetch_row($consulta);

		// Valor do resultado
		$status = $resultado[0];

		// Verifica se status permite ativação
		if ($status == 3) {
			
			echo "<div align='center'><br><br>Cadastro SUSPENSO.<br><br><a href='$url_principal"."contato.php'>CONTATAR-NOS</a>.</div>";
		}
		else if ($status == 4) {

			echo "<div align='center'><br><br>Cadastro CANCELADO.<br><br><a href='$url_principal"."contato.php'>CONTATAR-NOS</a>.</div>";
		}
		else {

			// Monta SQL da atualização
			$sql = "
				UPDATE usuarios SET 
					status_id = '2', 
					alterado = NOW() 
				WHERE 
					login = '$login'
			";
			// Executa consulta SQL
			$consulta = mysqli_query($conexao, $sql);

			// Verifica se houve erro na consulta
			if (!$consulta) {

				$erro = mysqli_errno($conexao);

				echo "Não ativado. Erro: $erro";
			}
			else {
				echo "<div align='center'><br><br>Ativado com sucesso!<br><br><a href='$url_principal'>ACESSAR</a></div>";
			}
		}
		// Fecha conexão
		mysqli_close($conexao);
	}
?>