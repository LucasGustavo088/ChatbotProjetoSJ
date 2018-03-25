@extends('layouts.dashboard_layout') @section('dashboard_content')
<form action="{{ route('chatbot.p_adicionar_resposta') }}" method="POST">
    {{ csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                <i class="fas fa-sitemap"></i> Resposta (Adicione maneiras diferentes de perguntar o mesmo. Dessa forma, o robô entenderá melhor qual é a resposta associada para esse tópico).
            </h2>
        </div>
        <div class="panel-body">
            <div class="form-group row">
                <label for="resposta" class="col-sm-2 control-label">Categoria</label>
                <div class="col-sm-10">
                    <input type="text" name="categoria" placeholder="Digite a palavra-chave mais forte do tópico" class="form-control" id="resposta" rows="5">
                </div>
            </div>

            <div class="form-group row">
                <label for="resposta" class="col-sm-2 control-label">Resposta</label>
                <div class="col-sm-10">
                    <textarea type="text" name="resposta" placeholder="Resposta para as perguntas abaixo" class="form-control" id="resposta" rows="5"></textarea>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        <i class="fas fa-sitemap"></i> Perguntas 
                    </h2>
                </div>
                <div class="panel-body">
                    <div class="row container">
                        <button type="button" onclick="adicionar_pergunta()" class="btn btn-success" style="float: right;"><i class="fas fa-plus"></i> Adicionar pergunta</button>
                    </div>
                    
                    <div id="respostas_container" style="margin-top: 20px;">

                    </div>
                </div>
            </div>

            <div class="salvar_cancelar row" style="margin-top: 200px;;">
                <div class="col-md-2" style="float: right">
                    <button type="submit" class="btn btn-danger" id="cancelar">Cancelar</button>
                    <button type="submit" class="btn btn-success" id="salvar">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div id="clone_pergunta" style="display: none;">
    <div class="panel panel-default" id="div_pergunta$id">
        
        <div class="panel-body">
            <div class="form-group row">
                <label for="pergunta$id" class="col-sm-2 control-label">Pergunta #$id</label>
                <div class="col-sm-10">
                    <input type="pergunta$id" name="perguntas[$id][pergunta]" placeholder="Digite uma pergunta" class="form-control col-md-10" id="pergunta$id" rows="5"/>
                </div>
            </div>
            <a href="#/" onclick="remover_pergunta($id)" style="float: right;"><i class="fas fa-trash-alt"></i></a>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        adicionar_pergunta();
    });

    var contador_pergunta = 1;
    function adicionar_pergunta() {
        var id = contador_pergunta;
        var clone_pergunta = $('#clone_pergunta').html();
        clone_pergunta = str_replace('$id', id, clone_pergunta);
        $('#respostas_container').append(clone_pergunta);


        contador_pergunta++;
    }

    function remover_pergunta(id) {
        $('#div_pergunta' + id).remove();
    }

</script>
@endsection