<?php
class AdminClasse
{
    public function __construct()
    {
        if (isset($_POST['create'])) {
            $this->createClasse();
        }
        if (isset($_POST['update'])) {
            $this->updateClasse($_POST['update']);
        }
        if (isset($_POST['delete'])) {
            $this->deleteClasse($_POST['delete']);
        }
    }

    private function createClasse()
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO classes (name) VALUES (:name)');
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->execute();
    }

    private function updateClasse($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE classes SET name = :name WHERE id = :id');
        $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function deleteClasse($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM classes WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
