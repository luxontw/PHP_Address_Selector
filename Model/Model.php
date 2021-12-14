<?php

class Model
{
    protected $db = null;

    protected function __construct()
    {
        $this->db = Database::getConnection();
    }
}

abstract class Sql
{
    public string $sql;
}

interface QueryInterface
{
    public function bind($query);
}

abstract class Query extends Sql implements QueryInterface
{
    public string $sql;
    protected $query;
    protected $element;

    function __construct(?PDOStatement $query = null)
    {
        $this->query = $query;
        $this->element = $this;
    }

    abstract function bind($query);

    public function by(QueryInterface $element)
    {
        $this->element = $element;
    }

    public function result()
    {
        $this->element->bind($this->query);
        $this->query->execute();
        return $this->query->fetchAll();
    }
}