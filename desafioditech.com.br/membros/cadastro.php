<?php
	include "topo.php";
?>

<div class="titulo-pagina">
	Controle de Uso das<br>Salas de Reunião
</div>

<div class="form">
	<div class="form-titulo">
		Cadastro de Sala
	</div>
	<form id="form-cad-sala" name="form-cad-sala" method="post" action="Javascript: return false">
		<div>
			<input type="text" id="nome" name="nome" value="" maxlength="150" placeholder="Informe o nome da sala" title="Informe o nome da sala"></div>
		<div>
			<input type="text" id="capacidade" name="capacidade" value="" maxlength="4" placeholder="Informe a capacidade" title="Informe a capacidade"></div>
		<div>
			<select id="status" name="status">
				<option value="">-- Status --</option>
				<option value="Ativa" selected="selected">Ativa</option>
				<option value="Inativa">Inativa</option>
			</select></div>
		<div id="resposta"></div>
		<div>
			<input type="submit" id="cadastrar" name="cadastrar" value="Cadastrar"></div>
	</form>
</div>

<?php
	include "rodape.php";
?>
