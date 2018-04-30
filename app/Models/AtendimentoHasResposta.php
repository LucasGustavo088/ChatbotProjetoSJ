<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtendimentoHasResposta extends Model
{
    protected $table = 'atendimento_has_resposta';
    public $timestamps = false;

    public function resposta() {
        return $this->hasOne('App\Models\Resposta', 'ID', 'ID_RESPOSTA');
    }

}
