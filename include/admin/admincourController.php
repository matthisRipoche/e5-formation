<?php

class AdminCour
{
    public function __construct()
    {
        if (isset($_POST['add-cour'])) {
            $this->addCour();
        }
        if (isset($_POST['update-cour'])) {
            $this->updateCour($_POST['update-cour']);
        }
        if (isset($_POST['delete-cour'])) {
            $this->deleteCour($_POST['delete-cour']);
        }
    }

    private function addCour()
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO cours (classe, matiere, enseignant, date) VALUES (:classe_id, :subject_id, :user_id, :datetime)');
        $stmt->bindParam(':classe_id', $_POST['classe'], PDO::PARAM_INT);
        $stmt->bindParam(':subject_id', $_POST['matiere'], PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_POST['enseignant'], PDO::PARAM_INT);
        $stmt->bindParam(':datetime', $_POST['datetime'], PDO::PARAM_STR);
        $stmt->execute();
    }

    private function updateCour($id)
    {
        if (empty($_POST['classe'])) {
            $_POST['classe'] = null;
        }
        if (empty($_POST['matiere'])) {
            $_POST['matiere'] = null;
        }
        if (empty($_POST['enseignant'])) {
            $_POST['enseignant'] = null;
        }

        global $pdo;
        $stmt = $pdo->prepare('UPDATE cours SET classe = :classe_id, matiere = :subject_id, enseignant = :user_id, date = :datetime WHERE id = :id');
        $stmt->bindParam(':classe_id', $_POST['classe'], PDO::PARAM_INT);
        $stmt->bindParam(':subject_id', $_POST['matiere'], PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_POST['enseignant'], PDO::PARAM_INT);
        $stmt->bindParam(':datetime', $_POST['datetime'], PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    private function deleteCour($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM cours WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
