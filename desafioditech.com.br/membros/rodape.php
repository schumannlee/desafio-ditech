
			</div>
			<div id="rodape">
				<?php echo $rodape_site; ?>
			</div>
		</div>
		<div id="topo">
			<div id="logo-site">
				<?php echo $logo_site; ?>
			</div>
			<div id="titulo-site">
				<?php echo "Acessando como: ".ucfirst($_SESSION['logado'])." ( ".$_SESSION['permissao']." )."; ?>
			</div>
			<div id="menu-site">
				<?php include "menu.php" ?>
			</div>
		</div>
	</body>

</html>