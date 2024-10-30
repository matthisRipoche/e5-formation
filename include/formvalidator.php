<?php
class FormValidator
{
    public function isSamePasswordConfirmed($password, $confirmPassword)
    {
        if ($password !== $confirmPassword) {
            return false;
        }
        return true;
    }

    public function isEmailExist($email, $pdo)
    {
        // Préparation de la requête SQL
        $sql = "SELECT COUNT(*) FROM users WHERE mail = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Exécution de la requête
        $stmt->execute();

        // Vérification du résultat
        if ($stmt->fetchColumn() == 0) {
            return false;
        }
        return true;
    }

    public function isPasswordCorrect($email, $password, $pdo)
    {
        // Préparation de la requête SQL
        $sql = "SELECT password FROM users WHERE mail = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Exécution de la requête
        $stmt->execute();
        // Récupération du mot de passe
        $hash = $stmt->fetchColumn();

        //verification du mot de passe
        if (!password_verify($password, $hash)) {
            return false;
        }

        return true;
    }
}
