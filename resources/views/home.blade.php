@extends('layouts.home_layout')

@section('content')
    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CART<i class="fa fa-circle"></i>RIO</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right"> 
                <li><a href="#">HOME</a></li>
                <li><a href="#red">SOBRE</a></li>
                <li><a href="#eq">EQUIPE</a></li>
                <li><a href="#ser">FALE CONOSCO</a></li>
            <li><a data-toggle="modal" data-target="#myModal" href="#myModal"><i class="fa fa-envelope-o"></i></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div id="headerwrap" src="{{ asset('images/header-bg.jpg') }}">
        <div class="container">
            <div class="row centered">
                <div class="col-lg-8 col-lg-offset-2">
                <br></br>
                <h1>Esclareça Suas <b>Dúvidas</b></h1>
                <h2>Com Agilidade e Seguraça</h2>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- headerwrap -->

    <!--Quem somos -->
    <div id="red">
        <div class="container">
            <div class="row centered">
                <div class="col-lg-8 col-lg-offset-2">
                <br></br>
                <br></br>
                <img src="{{ asset('images/maoV.png') }}" width="400" height="250" alt="">
                </div>
            </div><!-- row -->
        </div><!-- container -->


    <div id="r">
        <div class="container">
            <div class="row centered">
                <div class="col-lg-8 col-lg-offset-2">
                    <h4>SOBRE O PROJETO/CARTÓRIO CHATBOT</h4>
                    <p>O cartório chatbot é um projeto lançado em 2018 pelos alunos de Ciências da Computação da USJT, que visa melhoria nos meios de comunicação dentro de serviços referente a Cartório.

                    Temos como objetivo o desenvolvimento de um chatbot, software que trabalha e gerencia trocas de menssagem, de forma fácil e segura.
                    Para sustentar a qualidade dos serviços prestados, dispomos de infraestrutura tecnológica que garantem integridade, confidencialidade e inviolabilidade das informações envolvidas.</p>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div><! -- r wrap -->

    <!--  Equipe -->
    <div id = "eq" >
        <div class="container w" style="margin-top: 100px;">
            <div class="row centered">
                    <h4>NOSSA EQUIPE</h4>
                    <br></br>
                <div class="col-lg-4">
                    <img class="img-circle" src="{{ asset('images/pic2.jpg') }}" width="110" height="110" alt="">
                    <h4>Victoria Chelsea</h4>
                    <p>Sócio fundadora da empresa Cartório Chatbot<br>
                    Ciêntista da Computação<br>
                    Brasileira</p>
                    <p><a href="#">@Victoria_Chelsea</a></p>
                </div><!-- col-lg-3 -->

                <div class="col-lg-4">
                    <img class="img-circle" src="{{ asset('images/pic3.jpg') }}" width="110" height="110" alt="">
                    <h4>Bruna Gabriella</h4>
                    <p>Sócio fundadora da empresa Cartório Chatbot<br>
                    Ciêntista da Computação<br>
                    Brasileira</p>
                    <p><a href="#">@Bruna_Gabriella</a></p>
                </div><!-- col-lg-3 -->

                <div class="col-lg-4">
                    <img class="img-circle" src="{{ asset('images/pic4.jpg') }}" width="110" height="110" alt="">
                    <h4>Lucas Gustavo</h4>
                    <p>Sócio fundador da empresa Cartório Chatbot<br>
                    Ciêntista da Computação<br>
                    Brasileiro</p>
                    <p><a href="#">@Lucas_Gustavo</a></p>
                </div><!-- col-lg-3 -->
                <div class="row centered">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h4>"Tudo o que é simples, que simplifica a vida de todos nós, merece destaque."</b></h4>
                    </div>
                </div><!-- row -->

            </div><!-- row -->
        </div><!-- container -->
    </div><!-- eq -->

    <!-- Serviços -->
    <div id = ser>

        <div class="container w">
            <div class="row centered">
                <br><br>
                <div class="col-lg-4">
                    <i class="fa fa-desktop"></i>
                    <h4>WEB DESIGN</h4>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div><!-- col-lg-4 -->

                <div class="col-lg-4">
                    <i class="fa fa-cogs"></i>
                    <h4>WEB DEVELOPMENT</h4>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div><!-- col-lg-4 -->

                <div class="col-lg-4">
                    <i class="fa fa-eye"></i>
                    <h4>SEO SERVICES</h4>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div><!-- col-lg-4 -->
            </div><!-- row -->
            <br>
            <div class="row centered">
                <br><br>
                <div class="col-lg-4">
                    <i class="fa fa-heart"></i>
                    <h4>SOCIAL MEDIA</h4>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div><!-- col-lg-4 -->

                <div class="col-lg-4">
                    <i class="fa fa-shopping-cart"></i>
                    <h4>E-COMMERCE</h4>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div><!-- col-lg-4 -->

                <div class="col-lg-4">
                    <i class="fa fa-cloud"></i>
                    <h4>CLOUD SERVICES</h4>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.</p>
                </div><!-- col-lg-4 -->
            </div><!-- row -->
        </div>
    </div><!-- ser -->


    <!-- FOOTER -->
    <div id="f">
        <div class="container">
            <div class="row centered">
                <a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-dribbble"></i></a>
        
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- Footer -->

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<div id="clone_usuario_mensagem" style="display: none;">
    <div class="row msg_container base_sent">
        <div class="col-md-10 col-xs-10">
            <div class="messages msg_sent">
                <p>$mensagem</p>
                <time datetime="2009-11-13T20:00">dados_usuario.nome • Agora mesmo</time>
            </div>
        </div>
        <div class="col-md-2 col-xs-2 avatar">
            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
        </div>
    </div>
</div>

<!-- CLONES -->
<div id="clone_chatbot_mensagem" style="display: none;">
    <div class="row msg_container base_receive" id="clone_chatbot_mensagem$id">
        <div class="col-md-2 col-xs-2 avatar">
            <img src="http://www.bitrebels.com/wp-content/uploads/2011/02/Original-Facebook-Geek-Profile-Avatar-1.jpg" class=" img-responsive ">
        </div>
        <div class="col-xs-10 col-md-10">
            <div class="messages msg_receive">
                <p>$mensagem</p>
                <time datetime="2009-11-13T20:00">Chatbot • Agora mesmo <button onclick="finalizar_atendimento(); resposta_satisfatoria($id_pergunta_resposta)" style="width: 57px; height: 20px; font-size: 8px;" class="btn btn-success satisfacao" type="button">Satisfeito?</button></time>
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
  var id_atendimento = '';
  var travar_atualizacao = false;
  var dados_usuario = {
    nome: '',
    email: '' 
  };
  var contador_clone_chatbot_mensagem = 0;

  $(document).ready(function() {
      inicializar_chatbot();

      $('#nome').val('Teste');
      $('#email').val('teste@teste.com');
      
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
            retorno.atendimento.chat.forEach(function(chat) {
              if(chat["resposta"] != undefined) {
                adicionar_mensagem_usuario_atendente_caixa(chat.resposta.DESCRICAO);
              } else if (chat["pergunta"] != undefined) {
                adicionar_mensagem_usuario_caixa(chat.pergunta.DESCRICAO)
              }
            });
          }
        },
    });

    scroll_down_mensagem_enviada();
  }

  function adicionar_mensagem_usuario_atendente_caixa(mensagem) {
    var clone_usuario_chatbot = $('#clone_chatbot_mensagem').html();
    clone_usuario_chatbot = str_replace('$mensagem', mensagem, clone_usuario_chatbot);
    clone_usuario_chatbot = str_replace('$id_pergunta_resposta', null, clone_usuario_chatbot);
    clone_usuario_chatbot = str_replace('$id', contador_clone_chatbot_mensagem, clone_usuario_chatbot);

    $('#base_mensagens').append(clone_usuario_chatbot);
  }

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

  function finalizar_atendimento() {
    $('#base_mensagens').html('');
    $('#base_mensagens').append('<br><br><h4 style="text-align: center"><strong>Obrigado!</strong></h4><br><br><br><button type="button" class="btn btn-success" style="margin-left: 60px;" onclick="location.reload();">Perguntar novamente</button>');
    travar_atualizacao = true;
    $.ajax({
        url: '/chatbot_dialog/finalizar_atendimento',
        dataType: 'json',
        method: 'post',
        async: false,
        data: {
            '_token': "{{ csrf_token() }}",
            'id_atendimento': id_atendimento
        },
        error: function() {
          alert('Ops, houve um erro interno ao finalizar o atendimento.');
        }
    });
  }

  function salvar_informacoes_usuario() {
    if($('#nome').val() == '' || $('#email').val() == '') {
      alert('Insira os valores para iniciar o atendimento');
    } else {
      dados_usuario.nome = $('#nome').val();
      dados_usuario.email = $('#email').val();

      salvar_atendimento();

      $('#base_mensagens #identificacao').remove();
      $('#mensagem_input').prop('disabled', false);

      adicionar_mensagem_bot("Olá " + dados_usuario.nome + ". Em que posso te ajudar?", true);
    }
  }

  function salvar_atendimento() {
    $.ajax({
        url: '/chatbot_dialog/salvar_atendimento',
        dataType: 'json',
        method: 'post',
        async: false,
        data: {
            '_token': "{{ csrf_token() }}",
            'nome': dados_usuario.nome,
            'email': dados_usuario.email,
        },
        success: function(retorno) {
            id_atendimento = retorno.atendimento.id;
        },
        error: function() {
          alert('Ops, houve um erro interno. Verifique minha conexão.');
        }
    });
  }

  function inicializar_chatbot() {
    $('#base_mensagens').html('');
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
    
    adicionar_mensagem_usuario_caixa(obter_log_ultima_mensagem_usuario().mensagem);
    
    $('#mensagem_input').focus();
    $('#mensagem_input').val('');
    salvar_mensagem_banco('pergunta');
  }

  function adicionar_mensagem_usuario_caixa(mensagem) {
    var clone_usuario_mensagem = $('#clone_usuario_mensagem').html();
    clone_usuario_mensagem = str_replace('dados_usuario.nome', dados_usuario.nome, clone_usuario_mensagem)
    clone_usuario_mensagem = str_replace('$mensagem', mensagem, clone_usuario_mensagem);
    $('#base_mensagens').append(clone_usuario_mensagem);
  }

  function salvar_mensagem_banco(pergunta_ou_resposta) {
    if(pergunta_ou_resposta == 'pergunta') {
      $.ajax({
          url: '/chatbot_dialog/salvar_mensagem_banco/pergunta/' + id_atendimento,
          dataType: 'json',
          method: 'get',
          async: false,
          data: {
              '_token': "{{ csrf_token() }}",
              dados_mensagem: obter_log_ultima_mensagem_usuario()
          },
          success: function(retorno) {
              mensagem_chatbot = retorno.DESCRICAO;
          },
          error: function() {
            mensagem_chatbot = 'Ops, houve um erro interno.';
          }
      });
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

  function adicionar_mensagem_bot(mensagem, nao_perguntar_satisfacao) {
    if(contador_resposta == 3) {
      contador_resposta++;
      alert('Por favor, aguarde. Estamos iniciando o atendimento');
      setInterval(atualizar_chat, 3000);
      atualizar_status_atendimento('atendimento_iniciado');
      return false;
    }

    if(contador_resposta >= 3) {
        return false;
    }

    var mensagem_chatbot = {};
    if(typeof mensagem != 'undefined') {
      mensagem_chatbot.resposta = mensagem;
      mensagem_chatbot.id_pergunta_resposta = -1;
    } else {
      mensagem_chatbot = obter_resposta_ajax($('#mensagem_input').val());
    }

    var clone_usuario_chatbot = $('#clone_chatbot_mensagem').html();
    clone_usuario_chatbot = str_replace('$id_pergunta_resposta', mensagem_chatbot.id_pergunta_resposta, clone_usuario_chatbot);
    clone_usuario_chatbot = str_replace('$mensagem', mensagem_chatbot.resposta, clone_usuario_chatbot);
    clone_usuario_chatbot = str_replace('$id', contador_clone_chatbot_mensagem, clone_usuario_chatbot);

    $('#base_mensagens').append(clone_usuario_chatbot);
    contador_resposta++;
    if(nao_perguntar_satisfacao) {
      $('#clone_chatbot_mensagem' + contador_clone_chatbot_mensagem + ' .satisfacao').remove();
    }
    contador_clone_chatbot_mensagem++;
  }

  function atualizar_status_atendimento(status) {
    $.ajax({
        url: '/chatbot_dialog/atualizar_status_atendimento',
        dataType: 'json',
        method: 'post',
        async: false,
        data: {
            '_token': "{{ csrf_token() }}",
            'status': status,
            'id_atendimento': id_atendimento
        },
        error: function() {
          alert('Ops, houve um erro interno.')
        }
    });
  }

  function str_replace(find,replaceTo, str){
      find = find.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
      var re = new RegExp(find, 'g');
      str = str.replace(re,replaceTo);

      return str;
  }

  function obter_resposta_ajax(mensagem_usuario) {
    
    var resposta_chatbot = {};
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
            resposta_chatbot.resposta = retorno.pergunta_has_resposta.resposta.DESCRICAO;
            resposta_chatbot.id_pergunta_resposta = retorno.pergunta_has_resposta.ID_RESPOSTA;
        },
        error: function() {
          resposta_chatbot.resposta = 'Ops, houve um erro interno e não consegui achar o que procura. Verifique minha conexão.';
          resposta_chatbot.id_pergunta_resposta = -1;
        }
    });
    return resposta_chatbot;
  }

  function scroll_down_mensagem_enviada() {
    var scrollHeight = document.getElementById('base_mensagens').scrollHeight;
    document.getElementById('base_mensagens').scrollTop = scrollHeight;
  }

  function resposta_satisfatoria(id_pergunta_resposta) {
    if(typeof id_pergunta_resposta == 'undefined' || id_pergunta_resposta == null) {
      return false;
    }

    $.ajax({
        url: '/chatbot_dialog/resposta_satisfatoria',
        dataType: 'json',
        method: 'post',
        data: {
            '_token': "{{ csrf_token() }}",
            'id_pergunta_resposta': id_pergunta_resposta,
        },
        success: function(retorno) {
        },
        error: function() {
        }
    });
  }
</script>
@endsection
