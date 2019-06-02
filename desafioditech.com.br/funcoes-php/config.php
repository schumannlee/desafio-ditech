<?php
	// CONFIGURAÇÕES
	$url_base 		= $_SERVER['SERVER_NAME'];
	$url_base_teste = explode("/", $_SERVER['REQUEST_URI'])[1];

	// $url_principal 	= "http://".$url_base."/";
	$url_principal 	= "http://".$url_base."/".$url_base_teste."/";

	$jquery_lib 	= "<script type='text/javascript' src='".$url_principal."funcoes-js/jquery.min.js'></script>\n";

	$estilos_css 	= "<link rel='stylesheet' type='text/css' href='".$url_principal."estilos-css/base.css'>\n";
	$scripts_js 	= "<script type='text/javascript' src='".$url_principal."funcoes-js/base.js'></script>\n";

	$logo_site 		= "<img src='".$url_principal."arquivos/imagens/logo.png'>";
	$titulo_site 	= "Desafio Técnico Ditech - DEV PHP";
	$rodape_site 	= "Produção Jeferson Schumann - 2019";

?>