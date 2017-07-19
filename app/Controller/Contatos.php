<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 22:52
 */

namespace Mt4\ContatosAvaliacao\Controller;


use Mt4\ContatosAvaliacao\Model\ContatosModel;

class Contatos extends AbstractController
{
    public function run()
    {
        header('content-type:application/json; charset=utf-8');
        $contatos = new ContatosModel();
        echo json_encode($contatos->all()->fetchAll(\PDO::FETCH_ASSOC));
    }
}