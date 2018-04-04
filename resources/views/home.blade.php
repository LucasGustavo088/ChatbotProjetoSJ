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
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
    </div>
    <div class="row chat-window col-xs-5 col-md-3" id="chatbot1" style="margin-left:10px;">
        <div class="col-xs-12 col-md-12">
          <div class="panel panel-default">
                <div class="panel-heading top-bar grabbable">
                    <div class="col-md-8 col-xs-8">
                        <h3 class="panel-title"> Chat - Cartório</h3>
                    </div>
                    <div class="col-md-4 col-xs-4" style="text-align: right;">
                        <a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
                        <a href="#"><span data-id="chatbot1">X</span></a>
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
                <time datetime="2009-11-13T20:00">Usuário • 0 min</time>
            </div>
        </div>
        <div class="col-md-2 col-xs-2 avatar">
            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
        </div>
    </div>
</div>
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
<script>

    var ultimas_mensagens_usuario = [];

    $(document).ready(function() {

        document.querySelector('#mensagem_input').addEventListener('keypress', function (e) {
            var key = e.which || e.keyCode;
            if (key === 13) { // 13 é enter
                enviar_mensagem();  
            }
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
        }, 100);
        
        
    } 
  }

  var contador_resposta = -1;
  function adicionar_mensagem_usuario() {
    //Histórico de mensagens do usuário
    adicionar_log_ultima_mensagem_usuario();
    
    var clone_usuario_mensagem = $('#clone_usuario_mensagem').html();
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

  function adicionar_mensagem_bot() {
    var mensagem_chatbot = obter_resposta_ajax($('#mensagem_input').val());
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
