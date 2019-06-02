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

// FORMULÁRIO DE CADASTRO PARA USUÁRIOS
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

// FORMULÁRIO DE CADASTRO PARA SALAS
	// Valida entrada no campo capacidade
	$("#form-cad-sala #capacidade").keypress(function(e){
		
		var valor = $(this).val();

		var tecla = (window.event) ? event.keyCode : e.which;
		
		if((tecla > 47 && tecla < 58)) {
			
			$("input").css("border-color","unset")
			$("#resposta").html("");
			return true;
		}
		else {
			$(this).css("border-color","#FF0000");
			$("#resposta").html("Valor inválido em capacidade.");
			return (tecla == 8 || tecla == 0) ? true : false;
		}
	});
	// Cadastra sala
	$("#form-cad-sala #cadastrar").click(function(){

		// Limpa resposta do formulário
		$("#resposta").html("");
		$("#resposta").css("color","#FF0000");
		$("input").css("border-color","unset");

		// Captura valores do formulário
		var tabela		= "salas";
		var nome 		= $("#nome");
		var capacidade 	= $("#capacidade");
		var status 		= $("#status");

		// Verifica campos não preenchidos
		if (nome.val().trim() == "") {

			nome.css("border-color","#FF0000");
			$("#resposta").html("Informe o nome da sala.");
		}
		else if (capacidade.val().trim() == "") {

			capacidade.css("border-color","#FF0000");
			$("#resposta").html("Informe a capacidade da sala.");
		}
		else if (status.val().trim() == "") {

			status.css("border-color","#FF0000");
			$("#resposta").html("Informe o status da sala.");
		}
		// Submete valores do formuário
		else {
			$.post("../funcoes-php/cadastrar.php",
				{
				tabela: tabela,
				nome: nome.val().trim(),
				capacidade: capacidade.val().trim(),
				status: status.val().trim()
				},
				function(retorno, estado){
				
					// Verifica e exibe retorno
					if (retorno != "ok") {
						
						$("#resposta").html(retorno);
					}
					else {
						$("#cadastrar").remove();
						nome.attr("readonly",true);
						capacidade.attr("readonly",true);
						status.attr("readonly",true);
						$("#resposta").css("color","#006600");
						$("#resposta").html("Realizado com sucesso!");
					}
			});
		}
	});

// FUNÇÕES
function somenteNumeros(e) {
    
    var charCode = e.charCode ? e.charCode : e.keyCode;
    // charCode 8 = backspace   
    // charCode 9 = tab
    
    if (charCode != 8 && charCode != 9) {
    
        // charCode 48 equivale a 0   
        // charCode 57 equivale a 9
        if (charCode < 48 || charCode > 57) {
    
            return false;
        }
    }
}
});