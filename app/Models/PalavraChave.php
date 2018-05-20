<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PalavraChave extends Model
{
    protected $table = 'palavra_chave';
    public $timestamps = false; 

    public static function verificar_ja_existe_palavra_chave($palavra_chave) { COMO - como 

        $palavra_chave_cadastro = self::where('NOME', $palavra_chave)->get()->first();

        if(is_object($palavra_chave_cadastro) && $palavra_chave_cadastro->NOME == $palavra_chave) {
            return true;
        } else {
            return false;
        }

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

    public static function carregar_cadastro_completo($id) {

        return $topico;
    }

}
