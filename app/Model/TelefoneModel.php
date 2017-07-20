<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 19/07/17
 * Time: 13:54
 */

namespace Mt4\ContatosAvaliacao\Model;


class TelefoneModel extends AbstractModel
{
    protected $table = 'telefone';

    public function save(array $data)
    {
        $sql = sprintf('insert into %s (telefone, tipo, contatos_id) VALUES (:telefone, :tipo, :contatos_id)', $this->table);
        return $this->query($sql, $data);
    }

    public function update($data)
    {
        $sql = sprintf('update %s SET telefone=:telefone, tipo=:tipo where id=:id', $this->table);
        return $this->query($sql, $data);
    }
}