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
        debug(date('d/m/Y H:i:s'));die;
        $data_de = transformar_data(carregar_request('data_de'));
        $filtro['data_de'] = $data_de;

        $data_ate = transformar_data(carregar_request('data_ate'));
        $filtro['data_ate'] = $data_ate;

        $relatorio['filtro'] = $filtro;
        $relatorio['atendimentos'] = Atendimento::carregar_cadastros($filtro);
        debug($relatorio);die;
        return PDF::loadView('relatorio.gerar_relatorio', compact('relatorio'))
                    ->stream();
    }

}
