<?php

class EnseignantHomeController
{
    public function __construct()
    {
        if (isset($_POST['enablesign'])) {
            $this->enableSign($_POST['sign-cours-id']);
        }
    }

    private function enableSign($coursId)
    {
        global $pdo;
        $coursId = $_POST['sign-cours-id'];
        $stmt = $pdo->prepare('UPDATE cours SET statut = 1 WHERE id = :coursId');
        $stmt->bindParam(':coursId', $coursId, PDO::PARAM_INT);
        $stmt->execute();

        //redirect to the same page

        header('Location: ' . $_SERVER['REQUEST_URI']);
    }
}
