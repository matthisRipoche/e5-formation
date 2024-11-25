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

        if (isset($input['classId'])) {
            $classID = $input['classId'];

            // Inclure la connexion PDO
            include_once 'connexionbdd.php';


            // Préparer la requête avec les `JOIN` pour récupérer les informations des matières et professeurs en une seule requête
            global $pdo;
            $query = "
                SELECT 
                    cours.id,
                    cours.classe,
                    cours.date,
                    cours.timestart,
                    cours.timeend,
                    subjects.name AS matiere_name,
                    users.lastname AS professeur_name
                FROM cours
                LEFT JOIN subjects ON cours.matiere = subjects.id
                LEFT JOIN users ON cours.enseignant = users.id
                WHERE cours.classe = :class_id
            ";

            // Préparation et exécution de la requête
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':class_id', $classID, PDO::PARAM_INT);
            $stmt->execute();

            // Récupérer les résultats
            $courListe = $stmt->fetchAll();


            if ($courListe) {
                echo json_encode([
                    "status" => "success",
                    "message" => "Requête AJAX reçue avec succès",
                    "cour" => $courListe
                ]);
            } else {
                echo json_encode([
                    "status" => "success",
                    "message" => "Cette classe n'a pas de cours"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Aucun classId trouvé dans la requête."
            ]);
        }
    }
}
