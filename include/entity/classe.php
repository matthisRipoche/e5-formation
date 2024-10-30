<?php

class Classe
{
    private $id;
    private $name;

    public function __construct($id)
    {
        global $pdo;
        $this->id = $id;
        $this->load($pdo);
    }

    private function load($pdo)
    {
        $stmt = $pdo->prepare('SELECT * FROM classes WHERE id = :id');
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $classe = $stmt->fetch();
        if (!$classe) {
            throw new Exception('Classe not found');
        }
        $this->name = $classe['name'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
