<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtendimentoHasPergunta extends Model
{
    protected $table = 'atendimento_has_pergunta';
    public $timestamps = false;

    public function pergunta() {
        return $this->hasOne('App\Models\Pergunta', 'ID', 'ID_PERGUNTA');
    }
}
