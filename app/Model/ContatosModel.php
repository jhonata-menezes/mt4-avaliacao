<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 22:22
 */

namespace Mt4\ContatosAvaliacao\Model;


class ContatosModel extends AbstractModel
{
    const LIMIT = 10;
    protected $table = 'contatos';

    public function save($data)
    {
        $sql = sprintf('insert into %s (nome) VALUES (:nome)', $this->table);
        return $this->query($sql, [':nome' => $data['nome']]);
    }

    public function update($data)
    {
        $sql = sprintf('update %s SET nome=:nome where id=:id', $this->table);
        return $this->query($sql, $data);
    }

    public function page($page)
    {
        $page = $page == 0 ? 1 : $page;
        $offset = (($page * self::LIMIT) - self::LIMIT);
//        var_dump(self::LIMIT, $offset);
        $sql = sprintf('select * from %s LIMIT %d, %d', $this->table, $offset, self::LIMIT);
        return $this->query($sql, []);
    }
}