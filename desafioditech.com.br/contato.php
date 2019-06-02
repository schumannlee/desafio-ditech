<?php
	include "topo.php";
?>

<div class="titulo-pagina">
	Controle de Uso das<br>Salas de Reunião
</div>

<div class="form">
	<div class="form-titulo">
		Contato
	</div>
	<form id="form-contato" name="form-contato" method="post" action="Javascript: return false">
		<div>
			<select id="assunto" name="assunto">
				<option value="">-- Assunto --</option>
				<option value="senha">Recuperar Acesso</option>
				<option value="outro">Outro Assunto</option>
			</select></div>
		<div>
			<input type="email" id="email" name="email" value="" maxlength="150" placeholder="Informe seu e-mail" title="Informe seu e-mail"></div>
		<div>
			<textarea id="mensaagem" name="mensaagem" placeholder="Digite sua mensagem" title="Digite sua mensagem" maxlength="300"></textarea></div>
		<div id="resposta"></div>
		<div>
			<input type="submit" id="contatar" name="contatar" value="Contatar"></div>
	</form>
</div>

<?php
	include "rodape.php";
?>
