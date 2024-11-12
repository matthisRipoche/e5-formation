<?php

class Matiere
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
        $stmt = $pdo->prepare('SELECT * FROM subjects WHERE id = :id');
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $matiere = $stmt->fetch();
        if (!$matiere) {
            throw new Exception('Matiere not found');
        }
        $this->name = $matiere['name'];
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
