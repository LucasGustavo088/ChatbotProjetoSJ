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

        echo $respostas;
    }

    public function adicionar_palavra_chave_pergunta() {
        return view('chatbot.adicionar_palavra_chave_pergunta')
            ->with('palavras_chaves_prefixo_principais', (object) $this->palavras_chaves_prefixo_principais);
    }

    public function p_adicionar_palavra_chave_pergunta(Request $request) {

        $palavra_chave_principal = $request->palavra_chave_principal;
        $palavra_chave_principal = new PalavraChave();
        $palavra_chave_principal->PALAVRA_CHAVE_PRINCIPAL = '1';
        $palavra_chave_principal->ATIVO = '1';
        $palavra_chave_principal->DATA_CRIACAO = date('Y-m-d');
        $palavra_chave_principal->DATA_ATUALIZACAO = date('Y-m-d');
        $palavra_chave_principal->save();

        $respostas = $request->respostas;

        foreach($respostas as $resposta)  {
            $resposta_cadastro = new Resposta();
        }

        $perguntas = $request->perguntas;
        //Quebrando a resposta e perguntas em várias palavras chaves.
        $palavras_chaves_resposta = [];
        foreach($respostas as $resposta) {
            $palavras_chaves_resposta[] = $this->transformar_string_palavras_chave($resposta['resposta']);
            $palavra_chave_principal = new PalavraChave();
            $palavra_chave_principal->ATIVO = '1';
            $palavra_chave_principal->DATA_CRIACAO = date('Y-m-d');
            $palavra_chave_principal->DATA_ATUALIZACAO = date('Y-m-d');
            $palavra_chave_principal->save();
        }

        //Quebrando a resposta e perguntas em várias palavras chaves.
        $palavras_chaves_pergunta = [];
        foreach($perguntas as $pergunta) {
            $palavras_chaves_pergunta[] = $this->transformar_string_palavras_chave($pergunta['pergunta']);
            $palavra_chave_principal = new PalavraChave();
            $palavra_chave_principal->ATIVO = '1';
            $palavra_chave_principal->DATA_CRIACAO = date('Y-m-d');
            $palavra_chave_principal->DATA_ATUALIZACAO = date('Y-m-d');
            $palavra_chave_principal->save();
        }

        $resposta = new Resposta();
        $resposta->resposta = $request->resposta;
        $resposta->save();

        return view('chatbot.listar_perguntas_respostas');

    }

    public function transformar_string_palavras_chave($string) {
        $palavras_chave = [];
        $palavras_chave = explode(' ', $this->escapar_caracteres_notacao($string));
        return $palavras_chave;
    }

    public function escapar_caracteres_notacao($string) {
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace('.', '', $string);
        $string = str_replace('?', '', $string);
        $string = str_replace('!', '', $string);

        return $string;
    }
}
