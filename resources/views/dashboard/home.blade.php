@extends('layouts.dashboard_layout')

@section('dashboard_content')
<div class="breadcrumb" style="background: #f5f5f5">
    <button type="button" id="toggle_relatorio" class="btn btn-danger"><i class="fas fa-clipboard"></i> Relatórios</button>
</div>
<div class="container-row" id="div_relatorio" style="display: none;">
    <div class="form-group row">
        <label for="palavra_chave_principal" class="col-sm-2 control-label">Tópico principal</label>
        <div class="col-sm-10">
            <input type="text" required name="palavra_chave_principal" placeholder="Digite o tópico principal das perguntas e respostas. Ex: Certidão de nascimento" class="form-control" id="palavra_chave_principal" rows="5">
        </div>
    </div>
</div>
<table class="table" id="popular_tabela_atendimento">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do cliente</th>
            <th>Email</th>
            <th>Perguntas realizadas</th>
            <th>Status</th>
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
            ajax: '/dashboard/listar_pendencias_ajax',
            searching: false,
            bFilter: true,
            info:     false,
            lengthChange: false
        });

        $('#toggle_relatorio').click(function() {
            $('#div_relatorio').toggle();
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
