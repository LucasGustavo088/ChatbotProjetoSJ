<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Atendimento extends Model
{
    protected $table = 'atendimento';
    public $timestamps = false;


    public static function carregar_cadastro_completo($id_atendimento) {
        $atendimentos_principais = DB::table('atendimento')
            ->leftJoin('cliente', 'cliente.id', '=', 'atendimento.ID_CLIENTE')
            ->leftJoin('atendimento_has_pergunta', 'atendimento.ID', '=', 'atendimento_has_pergunta.ID_ATENDIMENTO')
            ->leftJoin('pergunta', 'atendimento_has_pergunta.ID_PERGUNTA', '=', 'pergunta.ID')
            ->leftJoin('atendimento_has_resposta', 'atendimento.ID', '=', 'atendimento_has_resposta.ID_ATENDIMENTO')
            ->leftJoin('resposta', 'atendimento_has_resposta.ID_RESPOSTA', '=', 'resposta.ID')
            ->select('atendimento.*', 'cliente.*', 'pergunta.descricao AS descricao_pergunta', 'resposta.descricao AS descricao_resposta')
            ->where('atendimento.ativo', '=', '1')
            ->where('atendimento.ID', $id_atendimento)
            ->get();

        return $atendimentos_principais;
    }
}
