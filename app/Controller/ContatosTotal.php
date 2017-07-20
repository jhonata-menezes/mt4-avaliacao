<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 19/07/17
 * Time: 21:00
 */

namespace Mt4\ContatosAvaliacao\Controller;


use Mt4\ContatosAvaliacao\Model\ContatosModel;

class ContatosTotal extends AbstractController
{
    public function run()
    {
        echo json_encode(['total' => (new ContatosModel())->all()->rowCount()]);
    }
}