<?php
new EnseignantEDTController();

class EnseignantEDTController
{
    public function getCours($enseignantID)
    {

        //get all cours with classID and SQL
        global $pdo;

        $sql = "
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
            WHERE cours.enseignant = :enseignant_id
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':enseignant_id', $enseignantID, PDO::PARAM_INT);
        $stmt->execute();
        $cours = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $cours;
    }
}
