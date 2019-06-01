<?php
	include "topo.php";
?>

<div class="titulo-pagina">
	Controle de Uso das<br>Salas de Reunião
</div>

<div class="form">
	<div class="form-titulo">
		Entrar no Sistema
	</div>
	<form id="form-logon" name="form-logon" method="post" action="Javascript: return false">
		<div>
			<input type="text" id="login" name="login" value="" maxlength="30" placeholder="Informe seu login" title="Informe seu login"></div>
		<div>
			<input type="password" id="senha" name="senha" value="" maxlength="30" placeholder="Informe sua senha" title="Informe sua senha"></div>
		<div>
			<input type="submit" name="logar" value="Acessar"></div>
		<div class="ajuda">
			<a href="cadastro.php">Não tenho cadastro</a></div><!--  class="indisponivel" -->
	</form>
</div>

<?php
	include "rodape.php";
?>
