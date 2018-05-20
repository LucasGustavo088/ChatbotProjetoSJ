@extends('layouts.dashboard_layout')

@section('dashboard_content')
<div class="container-row" style="background: #f5f5f5; padding: 10px; border: 1px solid #ddd;">
    <button type="button" id="toggle_relatorio" class="btn btn-danger"><i class="fas fa-clipboard"></i> Relatórios</button>
</div>
<div class="panel panel-default" id="div_relatorio" style="display: none; border-radius: 0px;">
    <form action="{{ route('relatorio.gerar_relatorio') }}" method="POST">
         {{ csrf_field() }}
        <div class="panel-body">
            <div class="form-group row col-md-6">
                <div class="col-md-4">
                    <label for="data_de" class="col-md-12 control-label">De</label>
                    <div class="col-md-12">
                        <input type="text" required name="data_de" placeholder="dd/mm/AAAA" class="datepicker form-control" id="data_de">
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="data_ate" class="col-md-12 control-label">Até</label>
                    <div class="col-md-12">
                        <input type="text" required name="data_ate" placeholder="dd/mm/AAAA" class="datepicker form-control" id="data_ate">
                    </div>
                </div>
            </div>
            <!-- <div class="form-group row col-md-6">
                <label for="outro_filtro" class="col-md-12 control-label">Outro filtro</label>
                <div class="col-md-10">
                    <input type="text" required name="outro_filtro" placeholder="Outro filtro" class="form-control" id="outro_filtro">
                </div>
            </div> -->

            <div class="form-group row col-md-12" style="margin-top: 15px;">
                <button type="submit" id="gerar_relatorio" style="float: right" class="btn btn-success"><i class="fas fa-clipboard"></i> Gerar</button>
            </div>
        </div>
    </form>
</div>

<table class="table" id="popular_tabela_atendimento">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome do cliente</th>
            <th>Email</th>
            <th>Data</th>
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
            lengthChange: false,
            order: [[ 0, "desc" ]]
        });

        $('#toggle_relatorio').click(function() {
            $('#div_relatorio').slideToggle();
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
