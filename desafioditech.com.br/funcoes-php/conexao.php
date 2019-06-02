<?php
	// Configura conexão
	$conexao = mysqli_connect("localhost","root","","reunioes");

	// Verifica se houve falha na conexão
	if (mysqli_connect_errno()) {
	
		echo "Falha ao conectar o banco de dados. Erro: " . mysqli_connect_error();
	}
?>