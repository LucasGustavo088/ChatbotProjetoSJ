<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resposta as Resposta;
use App\Models\PalavraChave as PalavraChave;
use App\Models\PerguntaHasResposta as PerguntaHasResposta;
use App\Models\Pergunta as Pergunta;
use App\Models\PalavraChaveHasResposta as PalavraChaveHasResposta;
use App\Models\PalavraChaveHasPergunta as PalavraChaveHasPergunta;
use App\Models\Topico as Topico;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers;

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
        // UtilizadorController::alerta('teste', 'danger');
        return view('chatbot.listar_topicos');
    }

    public function configuracoes_chatbot() {
        return view('chatbot.configuracoes_chatbot');
    }

    private function carregar_respostas() {
        $respostas = Resposta::orderBy('CRIADO', 'desc');
    }

    public function listar_topicos_ajax() {


        $topicos_principais = Topico::orderBy('DATA_CRIACAO', 'desc')->where('ATIVO', '=', '1')->get();
        $aaData = [];

        foreach ($topicos_principais as $key => $topico) {
            $botao_editar = ' <a href="' . url('chatbot/editar_palavra_chave_pergunta', array($topico->ID)) .  '" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Editar</a>';                                                                       
            $botao_excluir = ' <a href="' . url('chatbot/excluir_palavra_chave_pergunta', array($topico->ID)) .  '" class="btn btn-danger"><i class="fas fa-times"></i> Excluir</a>';                                                                       
            $aaData[] = [
                $topico->ID,
                $topico->NOME,
                date('d/m/Y', strtotime($topico->DATA_CRIACAO)),
                $botao_editar . $botao_excluir
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
        
        $topico = $this->carregar_topico($request->id);

        alerta('Funcionalidade de edição não habilitada ainda, Foi mal, espero que entenda :D');

        return view('chatbot.editar_palavra_chave_pergunta')
            ->with('topico', $topico);
    }

    public function excluir_palavra_chave_pergunta(Request $request) {
        Topico::where('ID', $request->id)
                  ->update(['ATIVO' => '0']);
        
        alerta('Tópico excluído com sucesso', 'success');

        return redirect()->route('chatbot.listar_topicos');
    }

    public function carregar_topico($id) {
        $topico = DB::table('topico')
            ->leftJoin('pergunta_has_resposta', 'pergunta_has_resposta.ID_TOPICO', '=', 'topico.ID')
            ->leftJoin('pergunta', 'pergunta_has_resposta.ID_PERGUNTA', '=', 'pergunta.ID')
            ->leftJoin('resposta', 'pergunta_has_resposta.ID_RESPOSTA', '=', 'resposta.ID')
            ->select('topico.*', 'pergunta_has_resposta.*', 'resposta.DESCRICAO as DESCRICAO_RESPOSTA', 'pergunta.DESCRICAO as DESCRICAO_PERGUNTA')
            ->where('topico.ID', '=', $id)
            ->where('topico.ativo', '=', '1')
            ->get();
            // ->first();

        return $topico;
    }

    public function p_adicionar_palavra_chave_pergunta(Request $request) {

        $topicos_principal = $request->topico;

        if($topicos_principal == '') {
            alerta('O tópico está vazio.', 'erro');
        }

        $topico = new Topico();
        $id_topico = $topico->salvar_topico($topicos_principal);

        $respostas = $request->respostas;
        $perguntas = $request->perguntas;
        $palavras_chaves_resposta = [];
        foreach($respostas as $key => $resposta) {
            $resposta_cadastro = new Resposta();
            $resposta_cadastro->DESCRICAO = $resposta['resposta'];
            $resposta_cadastro->DATA_CRIACAO = data_atual();
            $resposta_cadastro->DATA_ATUALIZACAO = data_atual();
            $resposta_cadastro->ATIVO = '1';
            $resposta_cadastro->save();

            $pergunta_cadastro = new Pergunta();
            $pergunta_cadastro->DESCRICAO = $perguntas[$key]['pergunta'];
            $pergunta_cadastro->DATA_CRIACAO = data_atual();
            $pergunta_cadastro->DATA_ATUALIZACAO = data_atual();
            $pergunta_cadastro->ATIVO = '1';
            $pergunta_cadastro->save();

            $pergunta_has_resposta = new PerguntaHasResposta();
            $pergunta_has_resposta->ID_PERGUNTA = $pergunta_cadastro->id;
            $pergunta_has_resposta->ID_RESPOSTA = $resposta_cadastro->id;
            $pergunta_has_resposta->DATA_CRIACAO = data_atual();
            $pergunta_has_resposta->DATA_ATUALIZACAO = data_atual();
            $pergunta_has_resposta->PONTUACAO = '0';
            $pergunta_has_resposta->ID_TOPICO = $id_topico;
            $pergunta_has_resposta->save();

            //Quebrando a resposta em várias palavras chaves.
            $palavras_chaves_resposta = $this->transformar_string_palavras_chave($resposta['resposta']);
            foreach ($palavras_chaves_resposta as $key_resposta => $palavra_chave_resposta) {
                if(PalavraChave::verificar_ja_existe_palavra_chave($palavra_chave_resposta)) {
                    $id_palavra_chave = PalavraChave::where('NOME', $palavra_chave_resposta)->get()->first()->ID;
                } else {
                    $palavra_chave_principal = new PalavraChave();
                    $palavra_chave_principal->NOME = $palavra_chave_resposta;
                    $palavra_chave_principal->ATIVO = '1';
                    $palavra_chave_principal->DATA_CRIACAO = data_atual();
                    $palavra_chave_principal->DATA_ATUALIZACAO = data_atual();
                    $palavra_chave_principal->save();
                    $id_palavra_chave = $palavra_chave_principal->id;
                }    

                $palavra_chave_has_resposta = new PalavraChaveHasResposta();
                $palavra_chave_has_resposta->ID_RESPOSTA = $resposta_cadastro->id; 
                $palavra_chave_has_resposta->ID_PALAVRA_CHAVE = $id_palavra_chave; 
                $palavra_chave_has_resposta->PONT_RESPOSTA = '0'; 
                $palavra_chave_has_resposta->save();
            }

            //Quebrando a perguntas em várias palavras chaves.
            $palavras_chaves_pergunta = $this->transformar_string_palavras_chave($perguntas[$key]['pergunta']);
            foreach ($palavras_chaves_pergunta as $key_pergunta => $palavra_chave_pergunta) {
                if(PalavraChave::verificar_ja_existe_palavra_chave($palavra_chave_pergunta)) {
                    $id_palavra_chave = PalavraChave::where('NOME', $palavra_chave_pergunta)->get()->first()->ID;
                } else {
                    $palavra_chave_principal = new PalavraChave();
                    $palavra_chave_principal->NOME = $palavra_chave_pergunta;
                    $palavra_chave_principal->ATIVO = '1';
                    $palavra_chave_principal->DATA_CRIACAO = data_atual();
                    $palavra_chave_principal->DATA_ATUALIZACAO = data_atual();
                    $palavra_chave_principal->save();
                    $id_palavra_chave = $palavra_chave_principal->id;
                }    

                $palavra_chave_has_pergunta = new PalavraChaveHasPergunta();
                $palavra_chave_has_pergunta->ID_PERGUNTA = $pergunta_cadastro->id; 
                $palavra_chave_has_pergunta->ID_PALAVRA_CHAVE = $id_palavra_chave; 
                $palavra_chave_has_pergunta->save();
            }
            
        }
        
        alerta('Tópico cadastrado com sucesso', 'success');

        return redirect()->route('chatbot.listar_topicos');

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

    public function debug($variavel) {
        echo '<pre>' . print_r($variavel, true) . '</pre>';
    }
}
