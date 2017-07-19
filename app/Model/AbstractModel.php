<?php
/**
 * Created by PhpStorm.
 * User: jhonata
 * Date: 18/07/17
 * Time: 20:34
 */

namespace Mt4\ContatosAvaliacao\Model;


abstract class AbstractModel
{
    /**
     * @var array
     */
    private $config = [];

    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @var string
     */
    protected $table;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/global.php';
        $this->config = $config['database'];
        $this->connection = new \PDO($this->config['dsn'], $this->config['username'], $this->config['password']);
    }

    public function query($sql, $params)
    {
        $prepare = $this->connection->prepare($sql);
        foreach ($params as $key => $param) {
            $prepare->bindColumn($key, $param);
        }
        if (!$prepare->execute()) {
            throw new \RuntimeException($prepare->errorCode() . $prepare->errorInfo());
        }
        return $prepare;
    }

    public function getById($id)
    {
        $sql = sprintf('select * from %s where id = :id', $this->table);
        return $this->query($sql, [':id' => $id]);
    }

    public function all()
    {
        return $this->query('select * from '. $this->table, []);
    }
}