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

    public function validate(array $data) {
        // verifica se existe os indices
        if (empty($data['nome'] || !isset($data['input']))) {
            return false;
        }

        // valida email e telefone
        foreach ($data['input'] as $item) {
            if(!empty($item['email']) && !preg_match('#^[\d\w]+\@\w+\.\w+(\.\w+)?$#i', $item['email'])) {
                return false;
            }
            if(!empty($item['telefone']) && !preg_match('#^\d{10,11}$#', $item['telefone'])) {
                return false;
            }
        }
        return true;
    }

    abstract function run();
}