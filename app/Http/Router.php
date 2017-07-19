<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 20:50
 */

namespace Mt4\ContatosAvaliacao\Http;


use Mt4\ContatosAvaliacao\Controller\Contatos;
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
        '/contatos' => Contatos::class,
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
        $controller = $this->routes[$this->requestBuilder->getServer()['REQUEST_URI']];

        $instance = new $controller($this->requestBuilder);
        $instance->run();
    }
    
}