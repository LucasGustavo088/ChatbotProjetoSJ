@extends('layouts.dashboard_layout')

@section('dashboard_content')
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
@endsection
