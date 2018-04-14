<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resposta as Resposta;
use App\Models\PalavraChave as PalavraChave;
use App\Models\PerguntaHasResposta as PerguntaHasResposta;
use App\Models\Pergunta as Pergunta;
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

    public function listar_topicos() {
        return view('chatbot.listar_topicos');
    }

    public function configuracoes_chatbot() {
        return view('chatbot.configuracoes_chatbot');
    }

    private function carregar_respostas() {
        $respostas = Resposta::orderBy('CRIADO', 'desc');
    }

    public function listar_topicos_ajax() {


        $topicos_principais = PalavraChave::where('PALAVRA_CHAVE_PRINCIPAL', '1')->orderBy('DATA_CRIACAO', 'desc')->get();

        foreach ($topicos_principais as $key => $topico) {
            $botao_editar = '<a href="' . url('chatbot/editar_palavra_chave_pergunta', array($topico->ID)) .  '" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Editar cadastro</a>';                                                                       
            $aaData[] = [
                $topico->ID,
                $topico->NOME,
                date('d/m/Y', strtotime($topico->DATA_CRIACAO)),
                $botao_editar
            ];
        }
        

        $resultados = ["sEcho" => 1,
            "iTotalRecords" => count($aaData),
            "iTotalDisplayRecords" => count($aaData),
            "aaData" => $aaData];


        echo json_encode($resultados);
    }

    public function adicionar_palavra_chave_pergunta() {
        return view('chatbot.adicionar_palavra_chave_pergunta')
            ->with('palavras_chaves_prefixo_principais', (object) $this->palavras_chaves_prefixo_principais);
    }

    public function editar_palavra_chave_pergunta(Request $request) {


        return view('chatbot.editar_palavra_chave_pergunta')
            ->with('cadastro', []);
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

            $pergunta_cadastro = new Pergunta();
            $pergunta_cadastro->DESCRICAO = $perguntas[$key]['pergunta'];
            $pergunta_cadastro->DATA_CRIACAO = date('Y-m-d');
            $pergunta_cadastro->DATA_ATUALIZACAO = date('Y-m-d');
            $pergunta_cadastro->ATIVO = '1';
            $pergunta_cadastro->save();

            $pergunta_has_resposta = new PerguntaHasResposta();
            $pergunta_has_resposta->ID_PERGUNTA = $pergunta_cadastro->id;
            $pergunta_has_resposta->ID_RESPOSTA = $resposta_cadastro->id;
            $pergunta_has_resposta->DATA_CRIACAO = date('Y-m-d');
            $pergunta_has_resposta->DATA_ATUALIZACAO = date('Y-m-d');
            $pergunta_has_resposta->PONT_RESPOSTA = '0';

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
