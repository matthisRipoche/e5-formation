<?php

class AdminCour
{
    public $error = '';

    public function __construct()
    {
        $this->error = '';
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
        //je veux vérifier que les classes ou le professeur n ont pas de cours au meme moment
        //recuperer les cours de la classe
        $stmt = $pdo->prepare('SELECT * FROM cours WHERE classe = :classe_id AND date = :date');
        $stmt->bindParam(':classe_id', $_POST['classe'], PDO::PARAM_INT);
        $stmt->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
        $stmt->execute();
        $coursListe = $stmt->fetchAll();
        foreach ($coursListe as $cours) {
            if ($_POST['timeStart'] >= $cours['timestart'] && $_POST['timeStart'] <= $cours['timeend']) {
                $this->error = 'La classe a déjà un cours à ce moment';
                return;
            }
            if ($_POST['timeEnd'] >= $cours['timestart'] && $_POST['timeEnd'] <= $cours['timeend']) {
                $this->error = 'La classe a déjà un cours à ce moment';
                return;
            }
        }

        $stmt = $pdo->prepare('INSERT INTO cours (classe, matiere, enseignant, date, timestart, timeend) VALUES (:classe_id, :subject_id, :user_id, :date, :timeStart, :timeEnd)');
        $stmt->bindParam(':classe_id', $_POST['classe'], PDO::PARAM_INT);
        $stmt->bindParam(':subject_id', $_POST['matiere'], PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_POST['enseignant'], PDO::PARAM_INT);
        $stmt->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
        $stmt->bindParam(':timeStart', $_POST['timeStart'], PDO::PARAM_STR);
        $stmt->bindParam(':timeEnd', $_POST['timeEnd'], PDO::PARAM_STR);
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
        $stmt = $pdo->prepare('UPDATE cours SET classe = :classe_id, matiere = :subject_id, enseignant = :user_id, date = :date, timestart = :timeStart, timeend = :timeEnd  WHERE id = :id');
        $stmt->bindParam(':classe_id', $_POST['classe'], PDO::PARAM_INT);
        $stmt->bindParam(':subject_id', $_POST['matiere'], PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_POST['enseignant'], PDO::PARAM_INT);
        $stmt->bindParam(':date', $_POST['date'], PDO::PARAM_STR);
        $stmt->bindParam(':timeStart', $_POST['timeStart'], PDO::PARAM_STR);
        $stmt->bindParam(':timeEnd', $_POST['timeEnd'], PDO::PARAM_STR);
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
