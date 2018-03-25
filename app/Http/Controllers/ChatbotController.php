<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resposta;

class ChatbotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listar_perguntas_respostas() {
        return view('chatbot.listar_perguntas_respostas');
    }

    public function configuracoes_chatbot() {
        return view('chatbot.configuracoes_chatbot');
    }

    private function carregar_respostas() {
        $respostas = Resposta::orderBy('CRIADO', 'desc');
    }

    public function listar_perguntas_respostas_ajax() {
        $respostas = Resposta::orderBy('CRIADO', 'desc');

        echo json_encode($respostas);
    }

    public function adicionar_resposta() {
        return view('chatbot.adicionar_resposta');
    }

    public function p_adicionar_resposta(Request $request) {
        $resposta = new Resposta();

        $resposta->categoria = $request->categoria;
        $resposta->resposta = $request->resposta;
        $resposta->save();

        return view('chatbot.listar_perguntas_respostas');

    }
}
