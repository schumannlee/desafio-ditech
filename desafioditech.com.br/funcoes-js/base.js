$(document).ready(function(){

// MENU PÚBLICO
	// Exibe opções do menu
	$("#menu span").mouseleave(function(){

		$("#menu-site nav").show();
	});
	// Oculta opções do menu
	$("*").click(function(){

		$("#menu-site nav").hide();		
	});
// FORMULÁRIO DE LOGON
	// Alerta indisponibilidade
	$(".indisponivel").click(function(){

		alert("Não disponível agora.");
	});
});