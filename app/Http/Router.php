<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 20:50
 */

namespace Mt4\ContatosAvaliacao\Http;


use Mt4\ContatosAvaliacao\Controller\Contatos;
use Mt4\ContatosAvaliacao\Controller\ContatosApagar;
use Mt4\ContatosAvaliacao\Controller\ContatosAtualizar;
use Mt4\ContatosAvaliacao\Controller\ContatosSalvar;
use Mt4\ContatosAvaliacao\Controller\ContatosTotal;
use Mt4\ContatosAvaliacao\Controller\Home;

class Router
{
    /**
     * @var RequestBuilder
     */
    protected $requestBuilder;

    /**
     * @var array
     */
    protected $routes = [
        '/' => Home::class,
        '/contatos(/[0-9]+)?' => Contatos::class,
        '/contatos/salvar' => ContatosSalvar::class,
        '/contatos/apagar/\d+' => ContatosApagar::class,
        '/contatos/atualizar/?' => ContatosAtualizar::class,
        '/contatos/total' => ContatosTotal::class,
    ];

    /**
     * Router constructor.
     * @param RequestBuilder $request
     */
    public function __construct(RequestBuilder $request)
    {
        $this->requestBuilder = $request;
    }

    public function run()
    {
        foreach ($this->routes as $key => $route) {
            if (preg_match("#^{$key}$#i", $this->requestBuilder->getServer()['REQUEST_URI'])) {
                $instance = new $route($this->requestBuilder);
                $instance->run();
                return;
            }
        }
        header('404 Not Found', true, 404);
    }
    
}