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
            // ->select()
            ->where('atendimento.ativo', '=', '1')
            ->where('atendimento.ID', $id_atendimento)
            ->get([
                'atendimento.*', 
                'cliente.*', 
                'pergunta.descricao AS descricao_pergunta', 
                'resposta.descricao AS descricao_resposta'
            ]);

        return $atendimentos_principais;
    }

    public function cliente() {
        return $this->hasOne('App\Models\Cliente', 'ID', 'ID_CLIENTE');
    }

    public function atendimento_has_pergunta() {
        return $this->hasMany('App\Models\AtendimentoHasPergunta', 'ID_ATENDIMENTO', 'ID');
    }

    public function atendimento_has_resposta() {
        return $this->hasMany('App\Models\AtendimentoHasResposta', 'ID_ATENDIMENTO', 'ID');
    }

    public static function carregar_cadastro($id_atendimento) {

        $atendimento = self::where('id', $id_atendimento)
            ->with([
                'cliente',
                'atendimento_has_pergunta.pergunta',
                'atendimento_has_resposta.resposta'
            ])
            ->where('id', $id_atendimento)
            ->get()
            ->first();

        return $atendimento->toArray();
    }

    public static function carregar_cadastros($filtro = []) {

        $query = self::query();

        $query = $query->with([
            'cliente',
            'atendimento_has_pergunta.pergunta',
            'atendimento_has_resposta.resposta'
        ]);

        if(isset($filtro['data_de'])) {
            $query->where('DATA_CRIACAO', '>=', $filtro['data_de']);
        }

        if(isset($filtro['data_ate'])) {
            $query->where('DATA_CRIACAO', '<=', $filtro['data_ate']);
        }

        $query = $query->get();

        return $query->toArray();
    }
}
