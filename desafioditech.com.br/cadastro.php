<?php
	include "topo.php";
?>

<div class="titulo-pagina">
	Controle de Uso das<br>Salas de Reunião
</div>

<div class="form">
	<div class="form-titulo">
		Cadastro no Sistema
	</div>
	<form id="form-cad-user" name="form-cad-user" method="post" action="Javascript: return false">
		<div>
			<input type="email" id="email" name="email" value="" maxlength="150" placeholder="Informe seu e-mail" title="Informe seu e-mail"></div>
		<div>
			<input type="text" id="login" name="login" value="" maxlength="30" placeholder="Crie seu login" title="Crie seu login"></div>
		<div>
			<input type="password" id="senha" name="senha" value="" maxlength="30" placeholder="Crie sua senha" title="Crie sua senha"></div>
		<div>
			<input type="password" id="senha-conf" name="senha-conf" value="" maxlength="30" placeholder="Confirme a senha" title="Confirme a senha"></div>
		<div>
			<input type="submit" name="cadastrar" value="Cadastrar"></div>
	</form>
</div>

<?php
	include "rodape.php";
?>
