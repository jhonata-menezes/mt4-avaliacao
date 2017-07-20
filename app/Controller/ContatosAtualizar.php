<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 19/07/17
 * Time: 20:22
 */

namespace Mt4\ContatosAvaliacao\Controller;


use Mt4\ContatosAvaliacao\Model\ContatosModel;
use Mt4\ContatosAvaliacao\Model\EmailModel;
use Mt4\ContatosAvaliacao\Model\TelefoneModel;

class ContatosAtualizar extends AbstractController
{
    public function run()
    {
        $body = json_decode(file_get_contents("php://input"), true);
        if ($this->validate($body)) {
            $this->atualizar($body);
            echo json_encode(['status' => 'ok']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function validate(array $data)
    {
        // verifica se existe os indices
        if (empty($data['nome'])) {
            return false;
        }

        // valida email e telefone
        foreach ($data['email'] as $item) {
            if(isset($item['email']) && !preg_match('#^[\d\w]+\@\w+\.\w+(\.\w+)?$#i', $item['email'])) {
                return false;
            }
        }
        foreach ($data['telefone'] as $item) {
                if(isset($item['telefone']) && !preg_match('#^\d{10,11}$#', $item['telefone'])) {
                return false;
            }
        }
        return true;
    }

    public function atualizar(array $data)
    {
        $contatoModel = new ContatosModel();
        $contatoModel->update([':nome' => $data['nome'], ':id' => $data['id']]);
        $emailModel = new EmailModel();
        $telefoneModel = new TelefoneModel();
        foreach ($data['email'] as $item) {
            $emailModel->update([':email' => $item['email'], 'tipo' => $item['tipo'], ':id' => $item['id']]);
        }
        foreach ($data['telefone'] as $item) {
            $telefoneModel->update([':telefone' => $item['telefone'], ':tipo' => $item['tipo'], ':id' => $item['id']]);
        }

    }
}