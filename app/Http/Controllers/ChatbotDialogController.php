<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resposta as Resposta;
use App\Models\PalavraChave as PalavraChave;
use App\Models\PalavraChaveHasResposta as PalavraChaveHasResposta;
use App\Models\Atendimento as Atendimento;
use App\Models\Cliente as Cliente;

class ChatbotDialogController extends Controller
{

    public $mensagem_resposta_nao_encontrada = 'Desculpe, não consegui entender o que quis dizer.';

    public function __construct()
    {
    }

    public function obter_resposta_ajax() {
        $mensagem_usuario = $_POST['mensagem_usuario'];
        $resposta = Resposta::where('DESCRICAO', 'like', '%' . $mensagem_usuario . '%')->get()->first();
                    
        if($resposta == null) {
            $resposta['DESCRICAO'] = $this->mensagem_resposta_nao_encontrada;
        }

        echo json_encode($resposta);
        exit();
    }

    public function salvar_atendimento(Request $request) {
        $cliente = new Cliente();
        $cliente->NOME_CLIENTE = $request->nome;
        $cliente->EMAIL_CLIENTE = $request->nome;
        $cliente->ATIVO = '1';
        $cliente->DATA_ATUALIZACAO = date('Y-m-d');
        $cliente->DATA_CRIACAO = date('Y-m-d');
        $cliente->save();
        
        $atendimento = new Atendimento();
        $atendimento->ATIVO = '1';
        $atendimento->STATUS = 'CHATBOT';
        $atendimento->ID_CLIENTE = $cliente->id;
        $atendimento->DATA_ATUALIZACAO = date('Y-m-d');
        $atendimento->DATA_CRIACAO = date('Y-m-d');
        $atendimento->QTD_TENTATIVA = '0';
        $atendimento->save();

        echo json_encode(['status' => true, 'atendimento' => $atendimento]);
        exit();
    }
}
