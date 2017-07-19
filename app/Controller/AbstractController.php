<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 20:44
 */

namespace Mt4\ContatosAvaliacao\Controller;


use Mt4\ContatosAvaliacao\Http\RequestBuilder;

abstract class AbstractController
{
    /**
     * @var RequestBuilder
     */
    protected $request;

    /**
     * AbstractController constructor.
     * @param RequestBuilder $request
     */
    public function __construct(RequestBuilder $request)
    {
        $this->request = $request;
    }

    abstract function run();
}