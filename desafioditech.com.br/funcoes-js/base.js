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

// FORMULÁRIO CADASTRO RESERVAS
	// Monta e exibe formulário criar reserva
	$(".acao-reserva .criar").click(function(){

		var tupla 		= $(this).parent().parent().parent();
		var sala_nome 	= tupla.find("td:eq(1)").html();
		var sala_id 	= tupla.attr("id");

		$("#sala-alvo").html(sala_nome);
		$("#sala-id").val(sala_id);

		$("#cad-reserva").show();
	});
	// Cancela intenção de criar reserva
	$("#cad-reserva #cancelar").click(function(){

		$("#cad-reserva #sala-alvo").html("");
		$("#cad-reserva #resposta").html("");
		$("#cad-reserva #sala-id").val("");
		$("#cad-reserva #horario").val("");
		$("#cad-reserva #data").val("");
		$("#cad-reserva").hide();
	});
	// Botão OK p/atualizar lista reservas
	$("#cad-reserva #ok").click(function(){

		location.href = location;
	});
	// Reativa foco no click em data
	$("#data").click(function(){
		$(this).select();
	});
	// Reativa foco no click em horário
	$("#horario").click(function(){
		$(this).select();
	});
	// Cadastra reserva
	$("#form-cad-reserva #criar").click(function(){

		// Limpa resposta do formulário
		$("#resposta").html("");
		$("#resposta").css("color","#FF0000");
		$("input").css("border-color","unset");

		// Captura valores do formulário
		var tabela		= "reservas";
		var logado_id	= $("#logado-id");
		var sala_id 	= $("#sala-id");
		var data 		= $("#data");
		var horario 	= $("#horario");

		// Verifica campos não preenchidos
		if (data.val().trim() == "") {

			data.css("border-color","#FF0000");
			$("#resposta").html("Informe a data de reserva.");
		}
		else if (horario.val().trim() == "") {

			horario.css("border-color","#FF0000");
			$("#resposta").html("Informe o horário de reserva.");
		}
		else if (dataInfoInvertida(data.val().trim()) < dataAtualInvertida()) {

			data.css("border-color","#FF0000");
			$("#resposta").html("Data inválida. Reveja.");
		}
		else if (dataHoraInfo(data.val(),horario.val()) < dataHoraAtual()) {

			horario.css("border-color","#FF0000");
			$("#resposta").html("Horário inválido. Reveja.");
		}
		// Submete valores do formuário
		else {

			$.post("../funcoes-php/cadastrar.php",
				{
				tabela: tabela,
				logado_id: logado_id.val(),
				sala_id: sala_id.val(),
				data: data.val(),
				horario: horario.val()+":00"
				},
				function(retorno, estado){
				
					// Verifica e exibe retorno
					if (retorno != "ok") {
						
						$("#resposta").html(retorno);
					}
					else {
						data.attr("readonly",true);
						data.css("text-align","right");
						horario.attr("readonly",true);
						$("#cancelar").remove();
						$("#criar").remove();
						$("#ok").show();
						$("#resposta").css("color","#006600");
						$("#resposta").html("Reserva criada com sucesso!");
					}
			});
		}
	});

// EXCLUIR RESERVAS
	$(".listagem-exibicao .reservas").click(function(){

		var logado_id 	= $("table").attr("id");
		var reserva_id 	= $(this).attr("id").split("@")[0];
		var usuario_id 	= $(this).attr("id").split("@")[1];
		var reserva_txt	= $(this).text();

		if (logado_id == usuario_id) {

			if (confirm("EXCLUIR\nMinha reserva?\n\n"+reserva_txt)) {

				$.post("../funcoes-php/excluir.php",
					{
					tabela: "reservas",
					reserva_id: reserva_id
					},
					function(retorno, estado){
					
						// Verifica e exibe retorno
						if (retorno != "ok") {
							
							alert("Falhou. Contate o administrador p/verificação.")
						}
						else {
							alert("Reserva excluída com sucesso!");
							location.href=location;
						}
				});
			}
		}

		// alert("Logado_id = "+logado_id+"\nReserva_id = "+reserva_id+"\nUsuario_id = "+usuario_id);
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

//Make the DIV element draggagle:
	dragElement(document.getElementById("cad-reserva"));

	function dragElement(elmnt) {
	  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
	  if (document.getElementById(elmnt.id + "header")) {
	    /* if present, the header is where you move the DIV from:*/
	    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
	  } else {
	    /* otherwise, move the DIV from anywhere inside the DIV:*/
	    elmnt.onmousedown = dragMouseDown;
	  }

	  function dragMouseDown(e) {
	    e = e || window.event;
	    e.preventDefault();
	    // get the mouse cursor position at startup:
	    pos3 = e.clientX;
	    pos4 = e.clientY;
	    document.onmouseup = closeDragElement;
	    // call a function whenever the cursor moves:
	    document.onmousemove = elementDrag;
	  }

	  function elementDrag(e) {
	    e = e || window.event;
	    e.preventDefault();
	    // calculate the new cursor position:
	    pos1 = pos3 - e.clientX;
	    pos2 = pos4 - e.clientY;
	    pos3 = e.clientX;
	    pos4 = e.clientY;
	    // set the element's new position:
	    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
	    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
	  }

	  function closeDragElement() {
	    /* stop moving when mouse button is released:*/
	    document.onmouseup = null;
	    document.onmousemove = null;
	  }
	}

// Retorna a data informada invertida
	function dataInfoInvertida(data) {

		return data.replace("-","").replace("-","");
	}

// Retorna timestamp data-hora informado
	function dataHoraInfo(data,hora) {

		return Date.parse(data+" "+hora+":00");
	}

// Retorna timestamp data-hora atual
	function dataHoraAtual() {

		var agora = new Date();
		var timestamp = agora.getTime();
		return timestamp;
	}

// Retorna a data atual invertida
	function dataAtualInvertida() {

		var data_atual = new Date();
		var dia = parseInt(data_atual.getDate());
		(dia < 10) ? dia = "0"+dia : dia = dia;
		var mes = parseInt(data_atual.getMonth()) + 1;
		(mes < 10) ? mes = "0"+mes : mes = mes;
		var ano = data_atual.getFullYear();
		data_atual = ano+""+mes+""+dia;
		return data_atual;
	}
});