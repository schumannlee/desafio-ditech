<?php
	date_default_timezone_set("America/Sao_Paulo");
	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";
	// die;
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
	// VERIFICA TABELA ALVO
		else if ($tabela == "salas") {

			// Inicializa variáves para inserção
			$nome 		= $_POST['nome'];
			$capacidade = $_POST['capacidade'];
			$status 	= $_POST['status'];

			// Monta SQL da inserção
			$sql = "
				INSERT INTO salas(
					nome,
					capacidade,
					status,
					criado,
					alterado
				) VALUES(
					'$nome', 
					'$capacidade', 
					'$status', 
					NOW(), 
					NOW()
				)
			";
			// Executa consulta SQL
			$consulta = mysqli_query($conexao, $sql);

			// Verifica se houve erro na consulta
			if (!$consulta) {

				echo "Não cadastrou. Erro: $erro";
			}
			else {
				echo "ok";
			}
		}
	// VERIFICA TABELA ALVO
		else if ($tabela == "reservas") {

			// Inicializa variáves para inserção
			$usuario_id = $_POST['logado_id'];
			$sala_id 	= $_POST['sala_id'];
			$data 		= $_POST['data'];
			$horario 	= $_POST['horario'];

			// Monta SQL da verificação de conflito em reservas
			$sql = "SELECT 
						data AS 'data_ate', 
						DATE_ADD(horario, INTERVAL 1 HOUR) AS 'hora_ate' 
					FROM reservas 
					WHERE sala_id='$sala_id' 
					AND data >= DATE_ADD(NOW(), INTERVAL -1 DAY) 
					ORDER BY 1,2
			";

			// Executa consulta SQL
			$consulta = mysqli_query($conexao, $sql);

			// Captura timestamp da data e hora informadas
			$timestamp_info = strtotime("$data $horario");
			// echo "$data $horario"; die;

			// Incializa array p/timestamps das reservas
			$timestamps_cad = array();

			// Obtém datas das reservas
			while ($datas = mysqli_fetch_assoc($consulta)) {

				// Captura timestamp das datas e horas cadastrados
				$timestamp_cad = strtotime($datas['data_ate']." ".$datas['hora_ate']);

				// Alimenta array com timestamps
				array_push($timestamps_cad, $timestamp_cad);
			}

			// Identificador entre-reservas
			$entre_reservas = 0;

			if (sizeof($timestamps_cad) > 0) {

				// Percorre timestamps p/comparação ao da data informada
				foreach ($timestamps_cad as $key => $value) {
					
					// Verifica intervalo entre reservas
					if ($key > 0 && $key < sizeof($timestamps_cad)) {

						// (Data-hora início da reserva) - (Data-hora final da reserva anterior)
						$intervalo = (($value-3600) - $timestamps_cad[$key-1]);

						if (
							($intervalo >= 3600) && // Há espaço suficiente entre-reservas
							($timestamp_info >= $timestamps_cad[$key-1]) && // Data-hora informado >= Data-hora da reserva anterior
							(($timestamp_info+3600) <= ($value-3600)) // Data-hora + 1 hora <= Data-hora inicial da próxima reserva
						) {
							$entre_reservas = 1;
							break;
						}
					}
				}

			// echo "<br>Entre-reserva: ".$entre_reservas;
			// echo "<br>Info-fim: ".date("d/m/Y H:i", ($timestamp_info+3600))." > Cad-Ini-Pri: ".date("d/m/Y H:i", ($timestamps_cad[0]-3600))." | ".intval(($timestamp_info+3600) > ($timestamps_cad[0]-3600));
			// echo "<br>Info-ini: ".date("d/m/Y H:i", $timestamp_info)." < Cad-Fin-Ult".date("d/m/Y H:i", ($timestamps_cad[sizeof($timestamps_cad)-1]))." | ".intval(($timestamp_info < ($timestamps_cad[sizeof($timestamps_cad)-1])));
			// die;

				// Não havendo entre-reserva possível verifica se reserva solicitada é anterior ou posterior à primeira e última reserva cadastrada
				if (
					$entre_reservas == 0 && // Não está entre-reservas
					($timestamp_info+3600) > ($timestamps_cad[0]-3600) && // Data-hora final informada >= Data-hora inicial da primeira reserva
					$timestamp_info < ($timestamps_cad[sizeof($timestamps_cad)-1]) // Data-hora início informada <= Data-hora final da última reserva
				) {

					echo "Período inválido.<br>Reveja a reserva.";
					exit;
				}
			}

			// Monta SQL da inserção
			$sql = "
				INSERT INTO reservas(
					usuario_id,
					sala_id,
					data,
					horario,
					criado,
					alterado
				) VALUES(
					'$usuario_id',
					'$sala_id',
					'$data',
					'$horario', 
					NOW(), 
					NOW()
				)
			";
			// Executa consulta SQL
			$consulta = mysqli_query($conexao, $sql);

			// Verifica se houve erro na consulta
			if (!$consulta) {

				echo "Não cadastrou. Erro: $erro";
			}
			else {
				echo "ok";
			}
		}
		// Fecha conexão
		mysqli_close($conexao);
	}
?>