<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UtilizadorController extends Controller
{

    public function __construct()
    {
        session_start();
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
}
