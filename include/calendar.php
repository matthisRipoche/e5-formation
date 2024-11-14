<?php

new AjaxCalendar();

class AjaxCalendar
{
    public function __construct()
    {
        $this->ajaxCalendar();
    }

    private function ajaxCalendar()
    {
        header('Content-Type: application/json');
        $input = json_decode(file_get_contents("php://input"), true);

        // Vérifier si courID est défini dans la requête
        if (isset($input['classId'])) {
            $classID = $input['classId'];

            include_once 'connexionbdd.php';

            // get cours with classID
            global $pdo;
            $stmt = $pdo->prepare('SELECT * FROM cours WHERE classe = :class_id');
            $stmt->bindParam(':class_id', $classID, PDO::PARAM_INT);
            $stmt->execute();

            $courListe = $stmt->fetchAll();

            if ($courListe) {
                foreach ($courListe as $cour) {
                    $matiereID = $cour['matiere'];
                    $stmt = $pdo->prepare('SELECT * FROM subjects WHERE id = :matiere_id');
                    $stmt->bindParam(':matiere_id', $matiereID, PDO::PARAM_INT);
                    $stmt->execute();
                    $matiere = $stmt->fetch();
                    // Ajouter le nom de la matière au tableau cour
                    $cour['matiere_name'] = $matiere['name'];

                    $professeurID = $cour['professeur'];
                    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :professeur_id');
                    $stmt->bindParam(':professeur_id', $professeurID, PDO::PARAM_INT);
                    $stmt->execute();
                    $professeur = $stmt->fetch();
                    //ajouter une ligne pour le nom du professeur
                    $cour['professeur_name'] = $professeur['name'];
                }

                echo json_encode([
                    "status" => "success",
                    "message" => "Ajax request received",
                    "class" => $classID,
                    "cours" => $courListe
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Impossible de récupérer les cours de la classe."
                ]);
                return;
            }
        } else {
            echo json_encode([
                "status" => "success",
                "message" => "No class ID found",
            ]);
        }
    }
}
