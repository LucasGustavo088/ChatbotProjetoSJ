@extends('layouts.dashboard_layout')

@section('dashboard_content')
<div class="chatbox col-md-12">
	<div class="chatlog" id="base_mensagens">
		
		
	</div>

	<div class="chat-forma">
		<textarea id="mensagem_input"></textarea>
		<button id="botao_enviar_mensagem" onclick="enviar_mensagem()">Enviar</button>
	</div>
</div>

<!-- CLONES  -->
<div id="clone_atendente" style="display: none;">
	<div class="chat atendente" id="">
		<div class="foto-user"><img src="{{ asset('images/atendente.png') }}"></div>
		<p class="mensagem-chat">$mensagem</p>
	</div>
</div>
<div id="clone_usuario_mensagem" style="display: none;">
	<div class="chat usuario">
		<div class="foto-user"><img src="{{ asset('images/usuario.png') }}"></div>
		<p class="mensagem-chat">$mensagem</p>
	</div>
</div>

<script>
	// Dados globais da página
    var id_atendimento = {!! json_encode($id_atendimento, JSON_UNESCAPED_UNICODE) !!};
    var travar_atualizacao = false;
    var dados_usuario = {
    	nome: 'Hernesto',
    	email: 'hernesto@bol.com.br',
    };

    var ultimas_mensagens_usuario_externo = [];
    var ultimas_mensagens_usuario = [];

	$(document).ready(function() {
		atualizar_chat();

		setInterval(atualizar_chat, 3000);

		document.querySelector('#mensagem_input').addEventListener('keypress', function (e) {
		    var key = e.which || e.keyCode;
		    if (key === 13) { // 13 é enter
		        enviar_mensagem();  
		    }
		});

	});

	function enviar_mensagem() {
	  if($('#mensagem_input').val() != '') {
	      adicionar_mensagem_usuario();

	      
          scroll_down_mensagem_enviada();
	  } 
	}

	function adicionar_mensagem_usuario() {
	  //Histórico de mensagens do usuário
	  adicionar_log_ultima_mensagem_usuario();
	  
	  adicionar_mensagem_usuario_caixa(obter_log_ultima_mensagem_usuario().mensagem);

	  $('#mensagem_input').val('');
	  $('#mensagem_input').focus();
	  scroll_down_mensagem_enviada();
	  salvar_mensagem_banco();
	}

	function adicionar_mensagem_usuario_caixa(mensagem) {
		var clone_usuario_mensagem = $('#clone_atendente').html();
		clone_usuario_mensagem = str_replace('dados_usuario.nome', dados_usuario.nome, clone_usuario_mensagem)
		clone_usuario_mensagem = str_replace('$mensagem', mensagem, clone_usuario_mensagem);
		$('#base_mensagens').append(clone_usuario_mensagem);
	}

	function scroll_down_mensagem_enviada() {
	  var scrollHeight = document.getElementById('base_mensagens').scrollHeight;
	  document.getElementById('base_mensagens').scrollTop = scrollHeight;
	}

	function atualizar_chat() {
		if(travar_atualizacao) {
			return false;
		}

		$('#base_mensagens').html('');

		$.ajax({
		    url: '/chatbot_dialog/carregar_mensagens_chat/' + id_atendimento,
		    dataType: 'json',
		    method: 'get',
		    async: false,
		    data: {
		        '_token': "{{ csrf_token() }}"
		    },
		    success: function(retorno) {
		    	if(retorno.atendimento != null) {
		    		if(retorno.atendimento.STATUS != 'atendimento_iniciado') {
		    			desabilitar_envio();
		    		} else {
		    			habilitar_envio();
		    		}

			    	retorno.atendimento.chat.forEach(function(chat) {
			    		if(chat["pergunta"] != undefined) {
			    			adicionar_mensagem_usuario_externo(chat.pergunta.DESCRICAO);
			    		} else if (chat["resposta"] != undefined) {
			    			adicionar_mensagem_usuario_caixa(chat.resposta.DESCRICAO)
			    		}
			    	});
		    	}
		    },
		});
	}

	function desabilitar_envio() {
		$('#mensagem_input').prop('disabled', true);
		$('#mensagem_input').attr('placeholder', 'Atendimento ainda não solicitado...');
		$('#botao_enviar_mensagem').hide();
	}

	function habilitar_envio() {
		$('#mensagem_input').prop('disabled', false);
		$('#mensagem_input').attr('placeholder', '');
		$('#botao_enviar_mensagem').show();
	}

	function salvar_mensagem_banco() {
		$.ajax({
		    url: '/chatbot_dialog/salvar_mensagem_banco/resposta/' + id_atendimento,
		    dataType: 'json',
		    method: 'get',
		    async: false,
		    data: {
		        '_token': "{{ csrf_token() }}",
		        dados_mensagem: obter_log_ultima_mensagem_usuario()
		    },
		    success: function(retorno) {

		    },
		    error: function() {
		      mensagem_chatbot = 'Ops, houve um erro interno.';
		    }
		});
	}

	function adicionar_mensagem_usuario_externo(mensagem) {
	  	//Histórico de mensagens do usuário
	  	adicionar_log_ultima_mensagem_usuario_externo(mensagem);
		adicionar_mensagem_usuario_externo_caixa();
	  	$('#mensagem_input').focus();
	}

	function adicionar_mensagem_usuario_externo_caixa(mensagem) {
		var clone_usuario_mensagem = $('#clone_usuario_mensagem').html();
		clone_usuario_mensagem = str_replace('dados_usuario.nome', dados_usuario.nome, clone_usuario_mensagem)
		clone_usuario_mensagem = str_replace('$mensagem', obter_log_ultima_mensagem_usuario_externo().mensagem, clone_usuario_mensagem);
		$('#base_mensagens').append(clone_usuario_mensagem);
	}

	function adicionar_log_ultima_mensagem_usuario_externo(mensagem_usuario) {
	  ultimas_mensagens_usuario_externo.push({
	      mensagem: mensagem_usuario,
	      data: new Date()
	  });
	}

	function obter_log_ultima_mensagem_usuario_externo() {
	  if(ultimas_mensagens_usuario_externo.length != 0) {
	      return ultimas_mensagens_usuario_externo.slice(-1)[0]; 
	  } else {
	      return 'Olá';
	  }
	}

	function adicionar_log_ultima_mensagem_usuario() {
	  ultimas_mensagens_usuario.push({
	      mensagem: $('#mensagem_input').val(),
	      data: new Date()
	  });
	}

	function obter_log_ultima_mensagem_usuario() {
	  if(ultimas_mensagens_usuario.length != 0) {
	      return ultimas_mensagens_usuario.slice(-1)[0]; 
	  } else {
	      return 'Olá';
	  }
	}
</script>
@endsection
