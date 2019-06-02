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
				Lista para Reservas
			</div>
			<div class="listagem-exibicao">

<?php
		// Conecta banco de dados
		require_once("../funcoes-php/conexao.php");

		// Monta consulta SQL
		$sql = "SELECT * FROM salas";

		// Executa consulta
		$consulta = mysqli_query($conexao, $sql);

		// Conta registros retornados
		$total = mysqli_num_rows($consulta);

		// Verifica se nenhum registro foi encontrado
		if ($total == 0) {
			
			// Exibe resultado na tela
			echo "Nenhuma sala cadastrada ainda";
		}
		else {
			// Inicializa enumerador dos resultados
			$enum = 0;
			// Inicializa Títulos da listagem
			$listagem = 
				"
					<table>
						<tr>
							<th>#</th>
							<th>Nome</th>
							<th>Capacidade</th>
							<th>Status</th>
							<th>Reserva</th>
						</tr>
				";
			// Obtém e insere resultados na listagem
			while ($resultado = mysqli_fetch_assoc($consulta)) {
				
				$enum++;
				$sala_id = $resultado['id'];

				// Consulta reservas da sala
				$sql2 = "SELECT * FROM reservas WHERE sala_id = '$sala_id' AND status = 'reservada'";
				$consulta2 = mysqli_query($conexao, $sql2);
				$total2 = mysqli_num_rows($consulta2);

				// Verifica se nenhuma reserva há
				if ($total2 == 0) {
					
					$reservas = "Nenhuma para esta sala.";
				}
				else {
					// Limpa variável
					$reservas = "";

					while ($resultado2 = mysqli_fetch_assoc($consulta2)) {
						// Lista reservas
						$reservas .= $resultado2['data']." ".$resultado2['horario']." - ";
					}
					// Ajusta resultado
					$reservas = substr($reservas, 0, strlen($reservas)-3);
				}

				// Alimenta tuplas da listagem
				$listagem .= 
					"
						<tr id='$sala_id'>
							<td rowspan='2'>".$enum."</td>
							<td>".$resultado['nome']."</td>
							<td>".$resultado['capacidade']."</td>
							<td>".$resultado['status']."</td>
							<td rowspan='2'><div class='acao-reserva'><div class='criar'>Criar</div><div class='alterar'>Alterar</div></div></td>
						</tr>
						<tr>
							<td align='right'><b>Reservas >></b></td>
							<td colspan='2'>$reservas</td>
						</tr>
					";
			}
			// Finaliza montagem da listagem
			$listagem .= "</table>";
			
			// Exibe resultado na tela
			echo $listagem;
		}
?>
			</div>
			
		</div>

		<div id="cad-reserva" class="form">
			<div id="mydivheader">Clique aqui p/mover</div>
			<div class="form-titulo">
				Reservando...
				<div id="sala-alvo"></div>
			</div>
			<form id="form-cad-reserva" name="form-cad-reserva" method="post" action="Javascript: return false">
				<div>
					<input type="date" id="data" name="data" value="" maxlength="10" placeholder="Informe a data da reserva" title="Informe a data da reserva"></div>
				<div>
					Horário: <input type="time" id="horario" name="horario" value="" maxlength="5" placeholder="Informe o horário da reserva" title="Informe o horário da reserva"></div>
				<div>
				<div id="resposta"></div>
				<div>
					<input type="button" id="cancelar" name="cancelar" value="Cancelar">&nbsp;&nbsp;
					<input type="submit" id="criar" name="criar" value="Criar"></div>
			</form>
		</div>
<?php
		include "rodape.php";

	}
?>