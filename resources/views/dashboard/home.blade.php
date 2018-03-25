@extends('layouts.dashboard_layout')

@section('dashboard_content')
<h2>Pendências de atendimento</h2>

<table class="table" id="popular_tabela_atendimento">
    <thead>
        <tr>
            <th>Nome do usuário</th>
            <th>Email</th>
            <th>Pendências</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script type="text/javascript">
    var popular_tabela_atendimento = "";
    $(document).ready(function () {
        
    });

    var linhas = 20;
    for(i = 1; i < linhas; i++) {
        popular_tabela_atendimento += `<tr>popular_tabela_atendimento
        <td>Usuário ${i}</td>
        <td>email${i}@teste.com</td>
        <td>prioridade ${i}</td>
        <td><button class="btn btn-danger"><i class="glyphicon glyphicon-comment"></i> Atender</button></td>
        </tr>`;
    }

    $('#popular_tabela_atendimento tbody').append(popular_tabela_atendimento);
</script>
@endsection
