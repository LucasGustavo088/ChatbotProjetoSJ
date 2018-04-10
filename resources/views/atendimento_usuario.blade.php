@extends('layouts.home_layout')

@section('content')
<style>
  /* CHAT  */
.chatbox {
    width: 1000px;
    min-width: 390px;
    height: 600px;
    background: #fff;
    padding: 10px;
    margin: 10px auto;
    box-shadow: 0 3px #ccc;
    border-radius: 10px 10px 10px;
    
    }
    
    .chatlog{
    padding: 10px;
    width: 100%;
    height: 450px;
    overflow-x: hidden;
    overflow-y: scroll;
    
    }
    
    .chatlog::-webkit-scrollbar {
    width: 10px;
    }
    
    .chatlog::-webkit-scrollbar-thumb {
    border-radius: 5px;
    background: rgba(0,0,0,.1)
    }
    
    .chat {
    display: flex;
    flex-flow: row wrap;
    align-items: flex-start;
    margin-bottom: 10px;
    }
    
    .chat .foto-user {
    width: 60px;
    height: 60px;
    background: #ccc;
    border-radius: 50%;
    overflow: hidden;
    }
    
    .chat .foto-user img{
    width: 100%;
    
    }
    
    .chat .mensagem-chat {
    width: 70%;
    padding: 15px;
    margin: 5px 10px 0;
    border-radius: 10px;
    color: #fff;
    font-size: 16px;
    }
    
    .usuario .mensagem-chat {
      background: #a7a7a7;
      order: -1;
    }
    
    .atendente .mensagem-chat {
      background: #d96d66;
    }
    
    .chat-forma {
    margin-top: 20px;
    display: flex;
    align-items: flex-start;
    }
    
    .chat-forma textarea {
    background: #fbfbfb;
    width: 75%;
    height: 50px;
    border: 2px slid #eee;
    border-radius: 3px
    resize: none;
    padding: 10px;
    font-size: 18px;
    color: #333;
    }
    
    .chat-forma textarea:focus {
    background: #fff;
    }
    
    .chat-forma textarea::-webkit-scrollbar {
    width: 10px;
    }
    
    .chat-forma textarea::-webkit-scrollbar-thumb {
    border-radius: 5px;
    background: rgba(0,0,0,.1)
    }
    
    .chat-forma button {
    background: #d96d66;
    padding: 5px 15px;
    font-size: 30px;
    color: #fff;
    border: none;
    margin: 0 10px;
    border-radius: 3px;
    box-shadow: 0 3px 0 #c7433b;
    cursor: pointer;
    -webkit-transition: background .2s ease;
    -moz-transition: background .2s ease;
    -o-transition: background .2s ease;
    }
    
    .chat-forma button:hover {
    background: #c7433b;
    
    }

</style>
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
    <div class="row">

   
    <div class="chatbox">
        <div class="chatlog">
          <div class="chat atendente">
            <div class="foto-user"><img src="{{ asset('images/atendente.png') }}"></div>
            <p class="mensagem-chat">Boa tarde Guilherme, em que posso ajudar? Vi que selecionou sobre <b>AUTENTICAÇÕES</b> mas qual sua duvida? Gostaria de saber quais documentos levar, onde fazer ou quanto custa?</p>
          </div>
          <div class="chat usuario">
            <div class="foto-user"><img src="{{ asset('images/usuario.png') }}"></div>
            <p class="mensagem-chat">quais documentos levar</p>
          </div>
          <div class="chat atendente">
            <div class="foto-user"><img src="{{ asset('images/atendente.png') }}"></div>
            <p class="mensagem-chat">Então vamos lá, é simples você precisa levar o documento original em bom estado e assinado, lembrando que se não estiver conservado o atendente pode não fazer o serviço. Mais alguma duvida?</p>
          </div>
          <div class="chat usuario">
            <div class="foto-user"><img src="{{ asset('images/usuario.png') }}"></div>
            <p class="mensagem-chat">preço</p>
          </div>
          <div class="chat atendente">
            <div class="foto-user"><img src="{{ asset('images/atendente.png') }}"></div>
            <p class="mensagem-chat">Sobre os valores, uma autenticação custa R$ 3,50 por folha. Lembrando que você pode levar suas xerox ou tirar no próprio cartório mas isso irá gerar um custo adicional.</p>
          </div>
          <div class="chat usuario">
            <div class="foto-user"><img src="{{ asset('images/usuario.png') }}"></div>
            <p class="mensagem-chat">obrigado</p>
          </div>
        </div>

        <div class="chat-forma">
          <textarea></textarea>
          <button>Enviar</button>
      </div>


      
    </div>
    <footer>
        <p>&copy; 2018 Company, Inc.</p>
    </footer>
</div>
@endsection
