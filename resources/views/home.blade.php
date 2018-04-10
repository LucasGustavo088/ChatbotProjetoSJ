@extends('layouts.home_layout')

@section('content')
<style></style>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="row">
    <div class="col-md-12" id="navegacao">
        <div class="container">
            <div class="row" id="img_logo" >
                <img src="{{ asset('images/logo.png') }}">
                <h3 id="header_titulo">Cartório Projeto Interdisciplinar</h3>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Serviços</a></li>
                <li><a href="#">Quem somos</a></li>
                <li><a href="#">Fale conosco</a></li>
                <li><a href="#">Cadastre-se</a></li>
            </ul>
            <input name="txtProcurar" id="txtProcurar" type="text"  placeholder="Digite aqui o que você procura...">
        </div>
    </div>
</div>   
</div>
<div class="container">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-4">
            <h2>Cartório</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">Ver detalhes &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>São Judas Tadeu</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">Ver detalhes &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Alunos</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">Ver detalhes &raquo;</a></p>
        </div>
    </div>
    <div class="row chat-window col-xs-5 col-md-3" id="chatbot1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading top-bar grabbable">
                <div class="col-md-8 col-xs-8">
                    <h3 class="panel-title"> <strong>Chatbot Cartório</strong></h3>
                </div>
                <div class="col-md-4 col-xs-4" style="text-align: right;">
                    <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                </div>
            </div>
            <div class="panel-body msg_container_base" style="height: 300px;" id="base_mensagens">
                
            </div>
            <div class="panel-footer">
                <input  id="mensagem_input" type="text" class="form-control" placeholder="Escreva aqui..." />
            </div>
          </div>
        </div>
    </div>
    <hr>
    <footer>
        <p>&copy; 2018 Company, Inc.</p>
    </footer>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</div>
<div id="clone_usuario_mensagem" style="display: none;">
    <div class="row msg_container base_sent">
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_sent">
                <p>$mensagem</p>
                <time datetime="2009-11-13T20:00">dados_usuario.nome • 0 min</time>
            </div>
        </div>
        <div class="col-md-2 col-xs-2 avatar">
            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
        </div>
    </div>
</div>

<!-- CLONES -->
<div id="clone_chatbot_mensagem" style="display: none;">
    <div class="row msg_container base_receive">
        <div class="col-md-2 col-xs-2 avatar">
            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
        </div>
        <div class="col-xs-10 col-md-10">
            <div class="messages msg_receive">
                <p>$mensagem</p>
                <time datetime="2009-11-13T20:00">Chatbot • 0 min</time>
            </div>
        </div>
    </div>
</div>
<div id="clone_identificacao" style="display: none;">
  <div id="identificacao" class="col-md-12" style="margin-top: 20px;">
    <div class="row form-group">
      <h5 style="text-align: center">Preencha os campos abaixo para iniciar o atendimento:</h5>
    </div>
    <div class="form-group row" style="margin-top: 10px;">
        <label for="nome" class="col-sm-2 control-label">Nome</label>
        <div class="col-sm-10">
            <input type="nome" name="dados_usuario[nome]" placeholder="Digite seu nome" class="form-control col-md-10" id="nome"/>
        </div>
    </div>
    <div class="form-group row" style="margin-top: 10px;">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" name="dados_usuario[email]" placeholder="Digite seu e-mail" class="form-control col-md-10" id="email"/>
        </div>
    </div>
    <div class="form-group row" style="margin-top: 20px;">
        <button style="margin-left: 100px;" id="enviar_informacoes_usuario" type="button" class="btn btn-success">Enviar</button>
    </div>
  </div>
</div>
<script>

  var ultimas_mensagens_usuario = [];
  var quantidade_resposta = 0;
  var dados_usuario = {
    nome: '',
    email: '' 
  };

  $(document).ready(function() {
      inicializar_chatbot();
      
      document.querySelector('#mensagem_input').addEventListener('keypress', function (e) {
          var key = e.which || e.keyCode;
          if (key === 13) { // 13 é enter
              enviar_mensagem();  
          }
      });

      $('#enviar_informacoes_usuario').click(function() {
        salvar_informacoes_usuario();
      });
  });

  $( function() {
   $( "#chatbot1" ).draggable();
  } );
  $(document).on('click', '.panel-heading span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
  });
  $(document).on('focus', '.panel-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideDown();
        $('#minim_chat_window').removeClass('panel-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
  });
  $(document).on('click', '#new_chat', function (e) {
    var size = $( ".chat-window:last-child" ).css("margin-left");
     size_total = parseInt(size) + 400;
    alert(size_total);
    var clone = $( "#chatbot1" ).clone().appendTo( ".container" );
    clone.css("margin-left", size_total);
  });
  $(document).on('click', '.icon_close', function (e) {
    //$(this).parent().parent().parent().parent().remove();
    $( "#chatbot1" ).remove();
  });

  

  function enviar_mensagem() {
    if($('#mensagem_input').val() != '') {
        adicionar_mensagem_usuario();

        scroll_down_mensagem_enviada();
        
        setTimeout(function() {
            adicionar_mensagem_bot();
            scroll_down_mensagem_enviada();
        }, 200);
    } 
  }

  function salvar_informacoes_usuario() {
    if($('#nome').val() == '' || $('#email').val() == '') {
      alert('Insira os valores para iniciar o atendimento');
    } else {
      dados_usuario.nome = $('#nome').val();
      dados_usuario.email = $('#email').val();

      $('#base_mensagens #identificacao').remove();
      $('#mensagem_input').prop('disabled', false);

      adicionar_mensagem_bot("Olá " + dados_usuario.nome + ". Em que posso te ajudar?");
    }
  }

  function inicializar_chatbot() {
    adicionar_identificacao();
    colocar_tela_chatbot_canto();
  }

  function adicionar_identificacao() {
    var clone_identificacao = $('#clone_identificacao').html();
    $('#base_mensagens').append(clone_identificacao);
    $('#mensagem_input').attr('disabled', 'disabled');
  }

  function colocar_tela_chatbot_canto() {
    $('#chatbot1').css('right', '0px');
    $('#chatbot1').css('bottom', '0px');
  }

  var contador_resposta = -1;
  function adicionar_mensagem_usuario() {
    //Histórico de mensagens do usuário
    adicionar_log_ultima_mensagem_usuario();
    
    var clone_usuario_mensagem = $('#clone_usuario_mensagem').html();
    clone_usuario_mensagem = str_replace('dados_usuario.nome', dados_usuario.nome, clone_usuario_mensagem)
    clone_usuario_mensagem = str_replace('$mensagem', obter_log_ultima_mensagem_usuario().mensagem, clone_usuario_mensagem);
    $('#base_mensagens').append(clone_usuario_mensagem);

    $('#mensagem_input').val('');
    $('#mensagem_input').focus();
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

  function adicionar_mensagem_bot(mensagem, perguntar_satisfacao) {
    
    if(typeof mensagem != 'undefined') {
      mensagem_chatbot = mensagem;
    } else {
      var mensagem_chatbot = obter_resposta_ajax($('#mensagem_input').val());
    }

    var clone_usuario_chatbot = $('#clone_chatbot_mensagem').html();
    clone_usuario_chatbot = str_replace('$mensagem', mensagem_chatbot, clone_usuario_chatbot);
    $('#base_mensagens').append(clone_usuario_chatbot);
  }

  function str_replace(find,replaceTo, str){
      find = find.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
      var re = new RegExp(find, 'g');
      str = str.replace(re,replaceTo);

      return str;
  }

  function obter_resposta_ajax(mensagem_usuario) {
    var mensagem_chatbot = '';
    $.ajax({
        url: '/chatbot_dialog/obter_resposta_ajax',
        dataType: 'json',
        method: 'post',
        async: false,
        data: {
            '_token': "{{ csrf_token() }}",
            'mensagem_usuario': obter_log_ultima_mensagem_usuario().mensagem,
        },
        success: function(retorno) {
            mensagem_chatbot = retorno.DESCRICAO;
        },
        error: function() {
          mensagem_chatbot = 'Ops, houve um erro interno e não consegui achar o que procura. Verifique minha conexão.';
        }
    });
    return mensagem_chatbot;
  }

  function scroll_down_mensagem_enviada() {
    var scrollHeight = document.getElementById('base_mensagens').scrollHeight;
    document.getElementById('base_mensagens').scrollTop = scrollHeight;
  }
</script>
@endsection
