@extends('layouts.dashboard_layout')

@section('dashboard_content')
<div class="navbar">
    <a class="btn btn-success" href="{{ route('chatbot.adicionar_palavra_chave_pergunta') }}">Adicionar tópico principal</a>
</div>
<div style="clear: both;"></div>
<table class="table datatable table-striped" id="popular_tabela_atendimento">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tópico principal</th>
            <th>Data de criação</th>
            <th style="width: 200px;">Ações</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('.datatable').DataTable( {
            ajax: '/chatbot/listar_topicos_ajax',
            searching: false,
            bFilter: true,
            info:     false,
            lengthChange: false
        });
    });
</script>
@endsection
