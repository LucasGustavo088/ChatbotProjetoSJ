<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    protected $table = 'pergunta';
    public $timestamps = false;
    
    public function pergunta_has_resposta() {
        return $this->belongsTo('App\Models\PerguntaHasResposta', 'ID', 'ID_PERGUNTA');
    }   
}
