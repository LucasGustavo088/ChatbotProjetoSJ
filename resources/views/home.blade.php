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
    <hr>
    <footer>
        <p>&copy; 2018 Company, Inc.</p>
    </footer>
</div>
@endsection
