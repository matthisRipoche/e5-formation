<?php
class AdminUser
{
    private $listeRoles = [
        'admin',
        'enseignant',
        'eleve'
    ];

    public function __construct($pdo)
    {
        if (isset($_POST['update'])) {
            $this->updateUser($_POST['update'], $pdo);
        }
        if (isset($_POST['delete'])) {
            $this->deleteUser($pdo, $_POST['delete']);
        }
    }

    private function updateUser($id, $pdo)
    {
        // Vérification si la classe est définie et non vide, sinon elle est définie à NULL
        $classe = isset($_POST['classe']) && !empty($_POST['classe']) ? $_POST['classe'] : null;

        // Préparation de la requête SQL pour mettre à jour un utilisateur
        $sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, mail = :email, role = :role, classe = :classe WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':firstname', $_POST['firstname'], PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $_POST['lastname'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        if (!isset($_POST['role'])) {
            $_POST['role'] = 'admin';
        }
        $stmt->bindParam(':role', $_POST['role'], PDO::PARAM_STR);

        // Si la classe est NULL, on utilise PDO::PARAM_NULL pour lier la valeur à la requête
        if ($classe === null) {
            $stmt->bindValue(':classe', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(':classe', $classe, PDO::PARAM_INT);
        }

        $stmt->execute();
    }

    private function deleteUser($pdo, $id)
    {
        // Préparation de la requête SQL pour supprimer un utilisateur*
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    //guetteur et setteur

    public function getListeRoles()
    {
        return $this->listeRoles;
    }
}
