<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 19/07/17
 * Time: 16:34
 */

namespace Mt4\ContatosAvaliacao\Controller;


use Mt4\ContatosAvaliacao\Model\ContatosModel;
use Mt4\ContatosAvaliacao\Model\EmailModel;
use Mt4\ContatosAvaliacao\Model\TelefoneModel;

class ContatosSalvar extends AbstractController
{
    public function run()
    {
        $body = json_decode(file_get_contents("php://input"), true);
        if ($this->validate($body)) {
            $this->save($body);
            echo json_encode(['status' => 'ok']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    
    public function save(array $data)
    {
        $contato = new ContatosModel();
        $contato->save($data);
        $id = $contato->getConnection()->lastInsertId();
        foreach ($data['input'] as $input) {
            if ($input['email']) {
                $emailModel = new EmailModel();
                $emailModel->save([':email' => $input['email'], ':tipo' => $input['emailTipo'], ':contatos_id' => $id]);
            }
            if ($input['telefone']) {
                $telefoneModel = new TelefoneModel();
                $telefoneModel->save([':telefone' => $input['telefone'], ':tipo' => $input['telefoneTipo'], ':contatos_id' => $id]);
            }
        }
    }
}