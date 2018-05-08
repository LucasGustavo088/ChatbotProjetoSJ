<?php 

if (! function_exists('debug')) {
    function debug($var, $sair = false) {
        echo "\n<pre>";
        if (is_array($var) || is_object($var)) {
            echo htmlentities(print_r($var, true));
        } else if (is_string($var)) {
            echo "string(" . strlen($var) . ") \"" . htmlentities($var) . "\"\n";
        } else {
            var_dump($var);
        }
        echo "</pre>";

        if ($sair) {
            die;
        }
    }
}

if (! function_exists('data_atual')) {
    function data_atual() {
        return date('Y-m-d H:i:s');
    }
}


if (! function_exists('data_atual')) {
    function data_atual() {
        return date('Y-m-d H:i:s');
    }
}


if(! function_exists('alerta')) {
    function alerta($mensagem, $tipo = null) {
        if($tipo == null) {
            $tipo = 'warning';
        }

        $_SESSION['alertas'][] = [
            'mensagem' => $mensagem,
            'tipo' => $tipo
        ];
    }  
}

if (! function_exists('carregar_request')) {
    function carregar_request($request = '') {

        if($request != '') {
            return $_POST[$request];
        } else {
            return $_POST;
        }
    }
}

if (! function_exists('transformar_data')) {
    function transformar_data($data) {
        $data = explode('/', $data);
        $data = $data[2] . '-' . $data[1] . '-' . $data[0];
        
        return $data;
    }
}

