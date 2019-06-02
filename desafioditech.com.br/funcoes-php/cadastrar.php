<?php
// VERIFICA SE POSTAGEM ESTÁ VAZIA
	if (!$_POST) {

		echo "Erro. Nada postado.";
	}
	else {
		// Conecta ao banco de dados
		require_once("conexao.php");

		$tabela = $_POST['tabela'];

	// VERIFICA TABELA ALVO
		if ($tabela == "usuarios") {

			// Inicializa variáves para inserção
			$email = $_POST['email'];
			$login = $_POST['login'];
			$senha = $_POST['senha'];

			// Monta SQL da inserção
			$sql = "
				INSERT INTO usuarios(
					email,
					login,
					senha,
					criado,
					alterado
				) VALUES(
					'$email', 
					'$login', 
					'$senha', 
					NOW(), 
					NOW()
				)
			";
			// Executa consulta SQL
			$consulta = mysqli_query($conexao, $sql);

			// Verifica se houve erro na consulta
			if (!$consulta) {

				$erro = mysqli_errno($conexao);

				if ($erro == "1062") {

					echo "E-mail ou login já em uso.";
				}
				else {
					echo "Não cadastrou. Erro: $erro";
				}
			}
			else {
				echo "ok";
			}
		}
		// Fecha conexão
		mysqli_close($conexao);
	}
?>