<?php
require_once __DIR__. '/../autoload.php';

$request = new \Mt4\ContatosAvaliacao\Http\RequestBuilder($_SERVER, $_POST, $_GET);
(new \Mt4\ContatosAvaliacao\Http\Router($request))->run();