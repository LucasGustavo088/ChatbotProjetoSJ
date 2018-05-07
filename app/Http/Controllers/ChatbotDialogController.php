<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resposta as Resposta;
use App\Models\PalavraChave as PalavraChave;
use App\Models\PalavraChaveHasResposta as PalavraChaveHasResposta;
use App\Models\Atendimento as Atendimento;
use App\Models\Cliente as Cliente;
use App\Models\Pergunta as Pergunta;
use App\Models\AtendimentoHasPergunta as AtendimentoHasPergunta;
use App\Models\AtendimentoHasResposta as AtendimentoHasResposta;
use App\Models\PerguntaHasResposta as PerguntaHasResposta;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers;
use \Datetime;

class ChatbotDialogController extends Controller
{

    public $mensagem_resposta_nao_encontrada = 'Desculpe, não consegui entender o que quis dizer.';

    public function __construct()
    {
    }

    public function obter_resposta_ajax() {
        $mensagem_usuario = $_POST['mensagem_usuario'];
        $resposta = DB::table('pergunta_has_resposta')
            ->leftJoin('pergunta', 'pergunta_has_resposta.ID_PERGUNTA', '=', 'pergunta.ID')
            ->leftJoin('resposta', 'pergunta_has_resposta.ID_RESPOSTA', '=', 'resposta.ID')
            ->select('resposta.*', 'pergunta_has_resposta.ID as id_pergunta_resposta')
            ->where('pergunta.DESCRICAO', 'LIKE', '%' . $mensagem_usuario . '%')
            ->get()
            ->first();
        // $resposta = Resposta::where('DESCRICAO', 'like', '%' . $mensagem_usuario . '%')->get()->first();
                    
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
        $cliente->DATA_ATUALIZACAO = data_atual();
        $cliente->DATA_CRIACAO = data_atual();
        $cliente->save();
        
        $atendimento = new Atendimento();
        $atendimento->ATIVO = '1';
        $atendimento->STATUS = 'Não finalizado';
        $atendimento->ID_CLIENTE = $cliente->id;
        $atendimento->DATA_ATUALIZACAO = data_atual();
        $atendimento->DATA_CRIACAO = data_atual();
        $atendimento->QTD_TENTATIVA = '0';
        $atendimento->save();

        echo json_encode(['status' => true, 'atendimento' => $atendimento]);
        exit();
    }

    public function salvar_mensagem_banco(Request $request) {
        
        if($request->pergunta_ou_resposta == 'pergunta') {
            $pergunta = new Pergunta();
            $pergunta->DESCRICAO = $request->dados_mensagem['mensagem'];
            $pergunta->ATIVO = '1';
            $pergunta->DATA_ATUALIZACAO = data_atual();
            $pergunta->DATA_CRIACAO = data_atual();
            $pergunta->save();

            $atendimento_has_pergunta = new AtendimentoHasPergunta();
            $atendimento_has_pergunta->ID_PERGUNTA = $pergunta->id;
            $atendimento_has_pergunta->ID_ATENDIMENTO = $request->id_atendimento;
            $atendimento_has_pergunta->DATA_CRIACAO = data_atual();
            $atendimento_has_pergunta->DATA_ATUALIZACAO = data_atual();
            $atendimento_has_pergunta->save();
        } else {
            $resposta = new Resposta();
            $resposta->DESCRICAO = $request->dados_mensagem['mensagem'];
            $resposta->ATIVO = '1';
            $resposta->DATA_ATUALIZACAO = data_atual();
            $resposta->DATA_CRIACAO = data_atual();
            $resposta->save();

            $atendimento_has_pergunta = new AtendimentoHasResposta();
            $atendimento_has_pergunta->ID_RESPOSTA = $resposta->id;
            $atendimento_has_pergunta->ID_ATENDIMENTO = $request->id_atendimento;
            $atendimento_has_pergunta->DATA_CRIACAO = data_atual();
            $atendimento_has_pergunta->DATA_ATUALIZACAO = data_atual();
            $atendimento_has_pergunta->save();
        }

        echo json_encode(['status' => true]);
        exit();

    }

    public function carregar_mensagens_chat(Request $request) {
        $atendimento = Atendimento::carregar_cadastro($request->id_atendimento);

        $atendimento['chat'] = array_merge($atendimento['atendimento_has_pergunta'], $atendimento['atendimento_has_resposta']);

        usort($atendimento['chat'], function($a, $b) {
          return new DateTime($a['DATA_CRIACAO']) <=> new DateTime($b['DATA_CRIACAO']);
        });
        echo json_encode(['status' => true, 'atendimento' => $atendimento]);
        exit();
    }

    public function atualizar_status_atendimento(Request $request) {
        if(isset($request->id_atendimento) && isset($request->status)) {
            
            Atendimento::where('ID', $request->id_atendimento)
                ->update(['STATUS' => $request->status]);

            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }

    public function resposta_satisfatoria(Request $request) {
        $retorno['status'] = false;

        if(isset($request->id_pergunta_resposta)) {
            
            $pergunta_has_resposta = PerguntaHasResposta::where('ID', $request->id_pergunta_resposta)->get()->first();
            $pontuacao = $pergunta_has_resposta->PONTUACAO;
            $pontuacao = intval($pontuacao) + 1;

            PerguntaHasResposta::where('ID', $request->id_pergunta_resposta)
                ->update(['PONTUACAO' => $pontuacao]);

            $retorno['status'] = true;
        } 

        echo json_encode($retorno);
        exit();
    }
}
