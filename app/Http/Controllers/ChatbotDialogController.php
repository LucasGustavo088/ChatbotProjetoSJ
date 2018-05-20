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
use App\Models\PalavraChaveHasPergunta as PalavraChaveHasPergunta;
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

        $palavras_chave_mensagem = $this->transformar_string_palavras_chave($mensagem_usuario);
        $palavra_chave_perguntas = array();

        /*
        * Obtendo todas as perguntas com as palavras-chaves da mensagem perguntada. 
        */ 
        foreach($palavras_chave_mensagem as $palavra_chave) {
            $palavra_chave_cadastro = PalavraChave::obter_palavra_chave_com_string($palavra_chave);
            if(!is_array($palavra_chave_cadastro)) {
                continue;
            }

            foreach($palavra_chave_cadastro as $palavra_chave) {
                $palavra_chave_perguntas[] = PalavraChave::carregar_cadastro_completo($palavra_chave['ID']);

            }
        }
        /*
        * Verificando a pergunta com maior peso a partir das palavras-chaves
        */
        foreach($palavra_chave_perguntas as &$palavra_chave_pergunta) {

            foreach($palavra_chave_pergunta['palavra_chave_has_pergunta'] as &$palavra_chave_has_pergunta) {
                if(empty($palavra_chave_has_pergunta['pergunta'])) {
                    continue;
                }

                /* ==== PESOS DE DEFINIÇÃO DE MELHOR RESPOSTA =====*/
                $peso = 0;

                //1) Número de ocorrências 
                $peso += $this->obterPesoComparacaoString(
                    $palavra_chave_has_pergunta['pergunta']['DESCRICAO'],
                    $palavras_chave_mensagem
                );

                //2) Respostas satisfatórias
                if(isset($palavra_chave_has_pergunta['pergunta']['pergunta_has_resposta']['PONTUACAO'])) {
                    $peso += $palavra_chave_has_pergunta['pergunta']['pergunta_has_resposta']['PONTUACAO'];
                }

                //3) Palavras-chaves contém no tópico principal
                if(isset($palavra_chave_has_pergunta['pergunta']['pergunta_has_resposta']['topico']['NOME'])) {
                    $peso += $this->obterPesoComparacaoString(
                        $palavra_chave_has_pergunta['pergunta']['pergunta_has_resposta']['topico']['NOME'],
                        $palavras_chave_mensagem
                    );
                }

                $palavra_chave_has_pergunta['pergunta']['peso_pergunta'] = $peso;
            }
        }        

        /*
        * Verificando qual pergunta_has_resposta tem maior peso de provável resposta.
        */
        $resposta = [];
        $maior_peso = -1;
        foreach($palavra_chave_perguntas as $palavra_chave_pergunta) {
            foreach($palavra_chave_pergunta['palavra_chave_has_pergunta'] as &$palavra_chave_has_pergunta) {
                if(empty($palavra_chave_has_pergunta['pergunta']['pergunta_has_resposta']['resposta']['DESCRICAO'])) {
                    continue;
                } else {
                    if($palavra_chave_has_pergunta['pergunta']['pergunta_has_resposta']['PONTUACAO'] > $maior_peso) {
                        $resposta = $palavra_chave_has_pergunta['pergunta'];
                    }
                    
                }
            }
        }
        
        $this->salvar_pergunta_usuario_externo($mensagem_usuario);

        if(empty($resposta)) {
            $resposta['pergunta_has_resposta']['resposta']['DESCRICAO'] = $this->mensagem_resposta_nao_encontrada;
            $resposta['pergunta_has_resposta']['ID_RESPOSTA'] = -1;
        }

        echo json_encode($resposta);
        exit();
    }

    public function obterPesoComparacaoString(String $texto, Array $possiveis_ocorrencias) {
        /*
        * Pesos:
        * Ocorrências no texto: 1 ponto;
        */

        $peso = 0;

        foreach($possiveis_ocorrencias as $possivel_ocorrencia) {
            $ocorrencias = substr_count($texto, $possivel_ocorrencia);
            if($ocorrencias > 0) {
                $peso++;
            }
        }

        return $peso;
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

    public function finalizar_atendimento(Request $request) {
        $retorno['status'] = false;

        $id_atendimento = carregar_request('id_atendimento');
        if($id_atendimento != '') {
            Atendimento::where('ID', $id_atendimento)
                ->update(['STATUS' => 'finalizado', 'DATA_FINALIZACAO' => data_atual()]);

            $retorno['status'] = true;
        }

        echo json_encode($retorno);
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

    public function transformar_string_palavras_chave($string) {
        $string = $this->escapar_caracteres_notacao($string);

        $palavras_chave = [];
        $palavras_chave = explode(' ', $string);
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

    public function salvar_pergunta_usuario_externo($pergunta) {
        $pergunta_cadastro = new Pergunta();
        $pergunta_cadastro->DESCRICAO = $pergunta;
        $pergunta_cadastro->DATA_CRIACAO = data_atual();
        $pergunta_cadastro->DATA_ATUALIZACAO = data_atual();
        $pergunta_cadastro->USUARIO_EXTERNO = '1';
        $pergunta_cadastro->ATIVO = '1';
        $pergunta_cadastro->save();
        
        $palavras_chaves_pergunta = $this->transformar_string_palavras_chave($pergunta);
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
}
