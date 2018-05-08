<?php

namespace App\Http\Controllers;

use App\Models\Atendimento as Atendimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class RelatorioController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listar_pendencias(Request $request) {

        return view('relatorio.listar_pendencias');
    }

    public function listar_pendencias_ajax() {
        
        $atendimentos_principais = DB::table('atendimento')
            ->leftJoin('cliente', 'cliente.id', '=', 'atendimento.ID_CLIENTE')
            ->select('atendimento.*', 'cliente.*')
            ->where('atendimento.ativo', '=', '1')
            ->get();

        $aaData = [];

        foreach ($atendimentos_principais as $key => $atendimento) {
            $botao_atender = ' <a onclick="redirecionar_para_atendimento(' . $atendimento->ID .')" class="btn btn-success"> Atender</a>'; 

            $status = 'Chatbot';

            if($atendimento->STATUS == 'atendimento_iniciado') {
                $status = 'Atendimento iniciado';
            } else {
                $botao_atender = ' <a onclick="redirecionar_para_atendimento(' . $atendimento->ID .')" class="btn btn-primary"> Visualizar</a>';
            }

            $aaData[] = [
                $atendimento->ID,
                $atendimento->NOME_CLIENTE,
                $atendimento->EMAIL_CLIENTE,
                date('d/m/Y', strtotime($atendimento->DATA_CRIACAO)),
                $status,
                $botao_atender
            ];
        }
        

        $resultados = ["sEcho" => 1,
            "iTotalRecords" => count($aaData),
            "iTotalDisplayRecords" => count($aaData),
            "aaData" => $aaData];


        echo json_encode($resultados);

    }

    public function gerar_relatorio(Request $request) {
        $relatorio = [];
        $filtro = [];

        $data_de = transformar_data(carregar_request('data_de'));
        $filtro['data_de'] = $data_de;

        $data_ate = transformar_data(carregar_request('data_ate'));
        $filtro['data_ate'] = $data_ate;

        $relatorio['filtro'] = $filtro;
        $relatorio['atendimentos'] = Atendimento::carregar_cadastros($filtro);

        $relatorio['quantidade_atendimentos']['1_tentativas'] = 0;
        $relatorio['quantidade_atendimentos']['2_tentativas'] = 0;
        $relatorio['quantidade_atendimentos']['3_tentativas'] = 0;
        $relatorio['quantidade_atendimentos']['encaminhamento_humano'] = 0;

        foreach($relatorio['atendimentos'] as &$atend) {

            //Quantidade de atendimentos
            if(count($atend['atendimento_has_pergunta']) == 1) {
                $relatorio['quantidade_atendimentos']['1_tentativas'] += 1;
            } else if(count($atend['atendimento_has_pergunta']) == 2) {
                $relatorio['quantidade_atendimentos']['2_tentativas'] += 1;
            } else if(count($atend['atendimento_has_pergunta']) == 3) {
                $relatorio['quantidade_atendimentos']['3_tentativas'] += 1;
            } else if(count($atend['atendimento_has_pergunta']) > 3) {
                $relatorio['quantidade_atendimentos']['encaminhamento_humano'] += 1;
            }

            //Duração da interação
            if($atend['DATA_FINALIZACAO'] != '' && $atend['DATA_CRIACAO'] != '') {
                $data_criacao = date_create($atend['DATA_CRIACAO']);
                $data_finalizacao = date_create($atend['DATA_FINALIZACAO']);
                $duracao = date_diff($data_criacao, $data_finalizacao);
                $atend['DURACAO_ATENDIMENTO'] = ($duracao->h != 0 ? $duracao->h . ' horas ' : '') . ($duracao->i != 0 ? $duracao->i . ' minutos ' : '') . ($duracao->s != 0 ? $duracao->s . ' segundos ' : '');
            } else {
                $atend['DURACAO_ATENDIMENTO'] = 'Não finalizado';
            }

        }


        return PDF::loadView('relatorio.gerar_relatorio', compact('relatorio'))
                    ->stream();
    }

}
