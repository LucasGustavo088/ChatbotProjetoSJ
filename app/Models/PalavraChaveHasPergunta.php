<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PalavraChaveHasPergunta extends Model
{
    protected $table = 'palavra_chave_has_pergunta';
    public $timestamps = false;

    public function pergunta() {
        return $this->hasOne('App\Models\Pergunta', 'ID', 'ID_PERGUNTA');
    }
}
