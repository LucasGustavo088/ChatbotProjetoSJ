<?php

namespace App\Http\Controllers;

use App\Models\Atendimento as Atendimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home() {
        return view('dashboard.home');
    }

    public function atendimento(Request $request) {

        return view('dashboard.atendimento')->with('id_cliente', $request->id);
    }

    public function listar_pendencias_ajax() {
        
        $atendimentos_principais = DB::table('atendimento')
            ->leftJoin('cliente', 'cliente.id', '=', 'atendimento.ID_CLIENTE')
            ->select('atendimento.*', 'cliente.*')
            ->where('atendimento.ativo', '=', '1')
            ->get();

        $aaData = [];

        foreach ($atendimentos_principais as $key => $atendimento) {
            $botao_atender = ' <a href="' . url('chatbot/editar_palavra_chave_pergunta', array($atendimento->ID)) .  '" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Editar</a>';                                                                       
            $botao_excluir = ' <a href="' . url('chatbot/excluir_palavra_chave_pergunta', array($atendimento->ID)) .  '" class="btn btn-danger"><i class="fas fa-times"></i> Excluir</a>'; 

            $aaData[] = [
                $atendimento->ID,
                $atendimento->NOME_CLIENTE,
                $atendimento->EMAIL_CLIENTE,
                date('d/m/Y', strtotime($atendimento->DATA_CRIACAO)),
                $botao_atender . $botao_excluir
            ];
        }
        

        $resultados = ["sEcho" => 1,
            "iTotalRecords" => count($aaData),
            "iTotalDisplayRecords" => count($aaData),
            "aaData" => $aaData];


        echo json_encode($resultados);

    }

    public function debug($variavel) {
        echo '<pre>' . print_r($variavel, true) . '</pre>';
    }

    
}
