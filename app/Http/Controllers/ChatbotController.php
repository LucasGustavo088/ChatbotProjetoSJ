<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resposta;

class ChatbotController extends Controller
{

    public $palavras_chaves_prefixo_principais = array (
        '0' => 'Como',
        '1' => 'O que é',
        '2' => 'Pra que serve',
        '3' => 'Quais são os documentos necessários'
    );


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

    public function adicionar_palavra_chave_pergunta() {
        return view('chatbot.adicionar_palavra_chave_pergunta')
            ->with('palavras_chaves_prefixo_principais', (object) $this->palavras_chaves_prefixo_principais);
    }

    public function p_adicionar_palavra_chave_pergunta(Request $request) {

        $respostas = $request->respostas;
        
        foreach($respostas as $resposta) {
            //Quebrando a resposta em várias palavras chaves.
            $palavras_chaves_resposta = explode(' ', $resposta);
            dd($palavras_chaves_resposta);
        }

        $perguntas = $request->perguntas;
        $resposta = new Resposta();
        $resposta->resposta = $request->resposta;
        $resposta->save();

        return view('chatbot.listar_perguntas_respostas');

    }
}
