<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 22:52
 */

namespace Mt4\ContatosAvaliacao\Controller;


use Mt4\ContatosAvaliacao\Model\ContatosModel;
use Mt4\ContatosAvaliacao\Model\EmailModel;
use Mt4\ContatosAvaliacao\Model\TelefoneModel;

class Contatos extends AbstractController
{
    public function run()
    {
        header('content-type:application/json; charset=utf-8');
        $page = $this->getPage();
        $contatos = new ContatosModel();
        $data = $contatos->page($page)->fetchAll(\PDO::FETCH_ASSOC);
        $data = $this->getTodosDados($data);
        echo json_encode($data);
    }

    public function getPage()
    {
        if (preg_match('#/contatos/(\d+)$#i', $this->request->getServer()['REQUEST_URI'], $m)) {
            return $m[1];
        }
        return 0;
    }

    /**
     * @param array $dados
     * @return array
     */
    protected function getTodosDados(array $dados)
    {
        foreach ($dados as &$dado) {
            $dado['email'] = (new EmailModel())->getByIdReferencia($dado['id'])->fetchAll(\PDO::FETCH_ASSOC);
            $dado['telefone'] = (new TelefoneModel())->getByIdReferencia($dado['id'])->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $dados;
    }
}