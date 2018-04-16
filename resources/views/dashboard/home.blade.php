@extends('layouts.dashboard_layout')

@section('dashboard_content')
<h2>Pendências de atendimento</h2>

<table class="table" id="popular_tabela_atendimento">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do cliente</th>
            <th>Email</th>
            <th>Perguntas realizadas</th>
            <th style="width: 200px;">Ações</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>

<script type="text/javascript">
    var popular_tabela_atendimento = "";
    $(document).ready(function () {
        $('#popular_tabela_atendimento').DataTable( {
            ajax: '/dashboard/listar_pendencias_ajax'
        });
    });

    function verificar_pendencia_nova() {
        setTimeout(function() {
            $('#popular_tabela_atendimento').data.reload();
        }, 1000);
    }

    function redirecionar_para_atendimento(id_atendimento) {
       window.open("{{ url('dashboard','atendimento') }}/" + id_atendimento, '_blank');
    }

    $('#popular_tabela_atendimento tbody').append(popular_tabela_atendimento);

</script>
@endsection
