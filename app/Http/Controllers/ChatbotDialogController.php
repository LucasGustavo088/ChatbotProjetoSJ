<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resposta as Resposta;
use App\Models\PalavraChave as PalavraChave;
use App\Models\PalavraChaveHasResposta as PalavraChaveHasResposta;

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
}
