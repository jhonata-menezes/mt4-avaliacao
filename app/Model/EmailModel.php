<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 19/07/17
 * Time: 13:54
 */

namespace Mt4\ContatosAvaliacao\Model;


class EmailModel extends AbstractModel
{
    protected $table = 'email';

    public function save(array $data)
    {
        $sql = sprintf('insert into %s (email, tipo, contatos_id) VALUES (:email, :tipo, :contatos_id)', $this->table);
        return $this->query($sql, $data);
    }

    public function update($data)
    {
        $sql = sprintf('update %s SET email=:email, tipo=:tipo where id=:id', $this->table);
        return $this->query($sql, $data);
    }

}