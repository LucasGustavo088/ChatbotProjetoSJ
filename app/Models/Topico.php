<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topico extends Model
{
    protected $table = 'topico';
    public $timestamps = false;

    public function salvar_topico($topico_principal) {
        $topico = $this;
        $topico->NOME = $topico_principal;
        $topico->ATIVO = '1';
        $topico->DATA_CRIACAO = data_atual();
        $topico->DATA_ATUALIZACAO = data_atual();
        $topico->save();

        return $topico->id;
    }

}
