<?php 

namespace Core\Database;

use Core\Database\Connection;

abstract class Model 
{
    /**
     * Database Connection
     *
     * @var \Core\Database\Connection
     */
    protected Connection $db;

    public function __construct()
    {
        $this->db = new Connection();
    }

    abstract protected function tableName(): string;

    abstract protected function fields(): array;

    /**
     * Executes given SQL query and return all rows
     *
     * @param string $sql
     * @param array $args
     * @return array|false
     */
    public function sql(string $sql, array $args = [])
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($args);

        return $stmt->fetchAll();
    }
}