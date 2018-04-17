@extends('layouts.dashboard_layout')

@section('dashboard_content')
<div class="chatbox col-md-12">
	<div class="chatlog" id="base_mensagens">
		
		
	</div>

	<div class="chat-forma">
		<textarea id="mensagem_input"></textarea>
		<button onclick="enviar_mensagem()">Enviar</button>
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
		travar_atualizacao = true;
	  //Histórico de mensagens do usuário
	  adicionar_log_ultima_mensagem_usuario();
	  
	  var clone_usuario_mensagem = $('#clone_atendente').html();
	  clone_usuario_mensagem = str_replace('dados_usuario.nome', dados_usuario.nome, clone_usuario_mensagem)
	  clone_usuario_mensagem = str_replace('$mensagem', obter_log_ultima_mensagem_usuario().mensagem, clone_usuario_mensagem);
	  $('#base_mensagens').append(clone_usuario_mensagem);

	  $('#mensagem_input').val('');
	  $('#mensagem_input').focus();

	  salvar_mensagem_banco();
	}

	function scroll_down_mensagem_enviada() {
	  var scrollHeight = document.getElementById('base_mensagens').scrollHeight;
	  document.getElementById('base_mensagens').scrollTop = scrollHeight;
	}

	function atualizar_chat() {
		if(travar_atualizacao) {
			return false;
		}
		console.log('teste');
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
			    	retorno.atendimento.forEach(function(atendimento) {
			    		adicionar_mensagem_usuario_externo(atendimento.descricao_pergunta);
			    	});
		    	}
		    },
		});

		scroll_down_mensagem_enviada();
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

	  var clone_usuario_mensagem = $('#clone_usuario_mensagem').html();
	  clone_usuario_mensagem = str_replace('dados_usuario.nome', dados_usuario.nome, clone_usuario_mensagem)
	  clone_usuario_mensagem = str_replace('$mensagem', obter_log_ultima_mensagem_usuario_externo().mensagem, clone_usuario_mensagem);
	  $('#base_mensagens').append(clone_usuario_mensagem);

	  
	  $('#mensagem_input').focus();

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
