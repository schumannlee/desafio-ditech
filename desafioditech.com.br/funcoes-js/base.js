$(document).ready(function(){

// MENU PÚBLICO
	// Exibe opções do menu
	$("#menu span").mouseover(function(){

		$("#menu-site nav").show();
	});
	// Oculta opções do menu
	$("*").click(function(){

		$("#menu-site nav").hide();		
	});

// FORMULÁRIO DE CADASTRO
	// Cadastra usuário
	$("#form-cad-user #cadastrar").click(function(){

		// Limpa resposta do formulário
		$("#resposta").html("");
		$("#resposta").css("color","#FF0000");
		$("input").css("border-color","unset");

		// Captura valores do formulário
		var tabela	= "usuarios";
		var email 	= $("#email");
		var login 	= $("#login");
		var senha 	= $("#senha");
		var confs 	= $("#senha-conf");
		var ativar 	= login.val().trim();

		// Verifica campos não preenchidos
		if (email.val().trim() == "") {

			email.css("border-color","#FF0000");
			$("#resposta").html("Informe seu e-mail.");
		}
		else if (login.val().trim() == "") {

			login.css("border-color","#FF0000");
			$("#resposta").html("Crie seu login.");
		}
		else if (senha.val().trim() == "") {

			senha.css("border-color","#FF0000");
			$("#resposta").html("Crie sua senha.");
		}
		else if (confs.val().trim() == "") {

			confs.css("border-color","#FF0000");
			$("#resposta").html("Confirme sua senha.");
		}
		else if (senha.val().trim() != confs.val().trim()) {

			confs.css("border-color","#FF0000");
			$("#resposta").html("Senhas diferentes.");
		}
		// Submete valores do formuário
		else {
			$.post("funcoes-php/cadastrar.php",
				{
				tabela: tabela,
				email: email.val().trim(),
				login: login.val().trim(),
				senha: senha.val().trim()
				},
				function(retorno, status){
				
					// Verifica e exibe retorno
					if (retorno != "ok") {
						
						$("#resposta").html(retorno);
					}
					else {
						senha.remove();
						confs.remove();
						$("#cadastrar").remove();
						email.attr("readonly",true);
						login.attr("readonly",true);
						$("#resposta").css("color","#006600");
						$("#resposta").html("Realizado com sucesso!<br><br>Clique no link enviado a seu e-mail<br>para concluir e ativar seu acesso.<br><br><a href='funcoes-php/ativar.php?login="+ativar+"'>LINK</a>");
					}
			});
		}
	});

// FORMULÁRIO DE LOGON
	// Logon de usuário
	$("#form-logon #logar").click(function(){

		// Limpa resposta do formulário
		$("#resposta").html("");
		$("#resposta").css("color","#FF0000");
		$("input").css("border-color","unset");

		// Captura valores do formulário
		var tabela	= "usuarios";
		var login 	= $("#login");
		var senha 	= $("#senha");

		// Verifica campos não preenchidos
		if (login.val().trim() == "") {

			login.css("border-color","#FF0000");
			$("#resposta").html("Informe seu login.");
		}
		else if (senha.val().trim() == "") {

			senha.css("border-color","#FF0000");
			$("#resposta").html("Informe sua senha.");
		}
		// Submete valores do formuário
		else {
			$.post("funcoes-php/consultar.php",
				{
				tabela: tabela,
				login: login.val().trim(),
				senha: senha.val().trim()
				},
				function(retorno, status){

					resposta = retorno.split("@")[0];
					mensagem = retorno.split("@")[1];
				
					// Verifica e exibe retorno
					if (resposta == "0") {
						
						$("#resposta").html(mensagem);
					}
					else {
						location.href=mensagem;
					}
			});
		}
	});

// FORMULÁRIO DE CONTATO
	// Contatar admin
	$("#form-contato #contatar").click(function(){

		$("#resposta").html("Indisponível no momento.");
	});
});