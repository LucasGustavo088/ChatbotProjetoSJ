<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PalavraChave extends Model
{
    protected $table = 'palavra_chave';
    public $timestamps = false; 

    public static function verificar_ja_existe_palavra_chave($palavra_chave) { 

        $palavra_chave_cadastro = self::where('NOME', $palavra_chave)->get()->first();

        if(is_object($palavra_chave_cadastro) && $palavra_chave_cadastro->NOME == $palavra_chave) {
            return true;
        } else {
            return false;
        }

    }

    public function palavra_chave_has_pergunta() {
        return $this->hasMany('App\Models\PalavraChaveHasPergunta', 'ID_PALAVRA_CHAVE', 'ID');
    }

    public static function carregar_cadastro_completo($id) {

        $palavra_chave = self::where('id', $id)
            ->with([
                'palavra_chave_has_pergunta.pergunta.pergunta_has_resposta.resposta',
                'palavra_chave_has_pergunta.pergunta.pergunta_has_resposta.topico',
            ])
            ->get()
            ->first();

        return $palavra_chave->toArray();
    }

    public static function obter_palavra_chave_com_string($palavra_chave) {
        $query = self::where('NOME', $palavra_chave)
            ->get();

        return $query->toArray();
    }

}
