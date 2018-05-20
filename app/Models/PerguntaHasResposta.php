<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerguntaHasResposta extends Model
{
    public $timestamps = false;
    protected $table = 'pergunta_has_resposta';

    public function resposta() {
        return $this->hasOne('App\Models\Resposta', 'ID', 'ID_RESPOSTA');
    }

    public function topico() {
        return $this->belongsTo('App\Models\Topico', 'ID_TOPICO', 'ID');
    }
}
