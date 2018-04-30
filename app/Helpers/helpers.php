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
