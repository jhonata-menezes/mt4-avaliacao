<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 19/07/17
 * Time: 19:13
 */

namespace Mt4\ContatosAvaliacao\Controller;


use Mt4\ContatosAvaliacao\Model\ContatosModel;

class ContatosApagar extends AbstractController
{
    public function run()
    {
        if (preg_match('#/contatos/apagar/(\d+)$#i', $this->request->getServer()['REQUEST_URI'], $m)) {
            (new ContatosModel())->apagar($m[1]);
            echo json_encode(['status' => 'ok']);
            return;
        }
        echo json_encode(['status' => 'error']);
    }
}