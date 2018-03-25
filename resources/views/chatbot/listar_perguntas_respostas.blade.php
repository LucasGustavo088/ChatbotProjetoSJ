@extends('layouts.dashboard_layout')

@section('dashboard_content')
<div class="navbar">
    <a class="btn btn-success" href="{{ route('chatbot.adicionar_resposta') }}">Adicionar resposta</a>
</div>
<div style="clear: both;"></div>
<table class="table datatable table-striped" id="popular_tabela_atendimento">
    <thead>
        <tr>
            <th>ID</th>
            <th>Resposta</th>
            <th>Data de criação</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('.datatable').DataTable( {
            ajax: '/chatbot/listar_perguntas_respostas_ajax'
        });
    });
</script>
@endsection
