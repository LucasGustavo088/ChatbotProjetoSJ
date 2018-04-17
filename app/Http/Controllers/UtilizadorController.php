<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UtilizadorController extends Controller
{

    public function __construct()
    {
    }

    public function remover_alerta(Request $request) {
        unset($_SESSION['alertas'][$request->id]);
    }

    public static function alerta($mensagem, $tipo) {
        $_SESSION['alertas'][] = [
            'mensagem' => $mensagem,
            'tipo' => $tipo
        ];
    }

    public static function debug($variavel) {
        echo '<pre>' . print_r($variavel, true) . '</pre>';
    }
}
