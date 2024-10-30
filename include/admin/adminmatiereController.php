<?php

class AdminMatiere
{
    public function __construct()
    {
        if (isset($_POST['create'])) {
            $this->createMatiere();
        }
        if (isset($_POST['update'])) {
            $this->updateMatiere($_POST['update']);
        }
        if (isset($_POST['delete'])) {
            $this->deleteMatiere($_POST['delete']);
        }
    }

    private function createMatiere()
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO subjects (name) VALUES (:name)');
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->execute();
    }

    private function updateMatiere($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE subjects SET name = :name WHERE id = :id');
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function deleteMatiere($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM subjects WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
