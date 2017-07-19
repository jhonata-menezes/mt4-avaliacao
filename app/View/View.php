<?php

/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 21:11
 */

namespace Mt4\ContatosAvaliacao\View;

class View
{
    public static function parse($view, array $params)
    {
        $file = __DIR__ . '/views/'. $view. '.php';
        if (!file_exists($file)) {
            throw new \RuntimeException('view nao existe ', $file);
        }
        $content = file_get_contents($file);
        foreach ($params as $key => $param) {
            $content = str_replace(sprintf('{{%s}}', $key), $param, $content);
        }
        echo $content;
    }
}