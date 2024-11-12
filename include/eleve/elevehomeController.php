<?php

class EleveHomeController
{

    public function __construct()
    {
        if (isset($_POST['valid_sign'])) {
            $this->AddSign();
        }
    }

    private function AddSign()
    {
        global $pdo;
        $coursId = $_POST['coursid'];
        $eleveID = $_SESSION['user']->getId();
        $filepath = $_POST['filepath'];
        $stmt = $pdo->prepare('INSERT INTO signature (eleve, cour, filepath) VALUES (:eleve, :cour, :filepath)');
        $stmt->bindParam(':eleve', $eleveID, PDO::PARAM_INT);
        $stmt->bindParam(':cour', $coursId, PDO::PARAM_INT);
        $stmt->bindParam(':filepath', $filepath, PDO::PARAM_STR);
        $stmt->execute();

        //redirect to the same page
        header('Location: ' . $_SERVER['REQUEST_URI']);
    }
}
