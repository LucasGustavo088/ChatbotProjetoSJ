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

}