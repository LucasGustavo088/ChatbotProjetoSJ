<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PalavraChave extends Model
{
    protected $table = 'palavra_chave';
    public $timestamps = false;

    public static function verificar_ja_existe_palavra_chave($palavra_chave) {

        if($palavra_chave == '') {
            return true;
        }
        echo($palavra_chave);die;
        $palavra_chave_cadastro = self::where('NOME', $palavra_chave)->get()->first();
        if(is_object($palavra_chave_cadastro) && $palavra_chave_cadastro->NOME == $palavra_chave) {
            return true;
        } else {
            return false;
        }

    }

    public static function carregar_topico($id) {
        // $topico = PalavraChave->hasMany('App\Models\PerguntaHasResposta');

        // ->where('PALAVRA_CHAVE_PRINCIPAL', '1')->where('ID', $request->id)->get()->first();

        // return $topico;
    }

}
