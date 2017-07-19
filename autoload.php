<?php

spl_autoload_register(function($file){
    $barra = str_replace('\\', '/', $file);
    $removeBase = str_replace('Mt4/ContatosAvaliacao', '/app', $barra);
    $file = __DIR__ . $removeBase . '.php';

    if (file_exists($file)) {
        require_once  $file;
        return;
    }
    throw new RuntimeException('nao foi possivel carregar a classe PHP '. $file);
});

