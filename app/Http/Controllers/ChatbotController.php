<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resposta as Resposta;
use App\Models\PalavraChave as PalavraChave;
use App\Models\PalavraChaveHasResposta as PalavraChaveHasResposta;

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

        if(!PalavraChave::verificar_ja_existe_palavra_chave($request->palavra_chave_principal)) {
            $palavra_chave_principal = new PalavraChave();
            $palavra_chave_principal->NOME = $request->palavra_chave_principal;
            $palavra_chave_principal->PALAVRA_CHAVE_PRINCIPAL = '1';
            $palavra_chave_principal->ATIVO = '1';
            $palavra_chave_principal->DATA_CRIACAO = date('Y-m-d');
            $palavra_chave_principal->DATA_ATUALIZACAO = date('Y-m-d');
            $palavra_chave_principal->save();
        }

        $respostas = $request->respostas;
        $perguntas = $request->perguntas;
        $palavras_chaves_resposta = [];
        foreach($respostas as $key => $resposta) {
            $resposta_cadastro = new Resposta();
            $resposta_cadastro->DESCRICAO = $resposta['resposta'];
            $resposta_cadastro->DATA_CRIACAO = date('Y-m-d');
            $resposta_cadastro->DATA_ATUALIZACAO = date('Y-m-d');
            $resposta_cadastro->ATIVO = '1';
            $resposta_cadastro->save();

            //Quebrando a resposta e perguntas em várias palavras chaves.
            $palavras_chaves_resposta[] = $this->transformar_string_palavras_chave($resposta['resposta'])[0];
            foreach ($palavras_chaves_resposta as $key => $palavra_chave_resposta) {
                if(PalavraChave::verificar_ja_existe_palavra_chave($palavra_chave_resposta)) {
                    $id_palavra_chave = PalavraChave::where('NOME', $palavra_chave_resposta)->get()->first()->ID;
                } else {
                    $palavra_chave_principal = new PalavraChave();
                    $palavra_chave_principal->NOME = $palavra_chave_resposta;
                    $palavra_chave_principal->ATIVO = '1';
                    $palavra_chave_principal->DATA_CRIACAO = date('Y-m-d');
                    $palavra_chave_principal->DATA_ATUALIZACAO = date('Y-m-d');
                    $palavra_chave_principal->save();
                    $id_palavra_chave = $palavra_chave_principal->id;
                }    

                $palavra_chave_has_resposta = new PalavraChaveHasResposta();
                $palavra_chave_has_resposta->ID_RESPOSTA = $resposta_cadastro->id; 
                $palavra_chave_has_resposta->ID_PALAVRA_CHAVE = $id_palavra_chave; 
                $palavra_chave_has_resposta->PONT_RESPOSTA = '0'; 
                $palavra_chave_has_resposta->save();
            }
            
        }

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
