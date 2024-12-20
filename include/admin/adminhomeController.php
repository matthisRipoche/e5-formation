<?php

class AdminHomeController
{
    public function __construct()
    {
        if ($_SERVER['REQUEST_URI'] == '/e5-formation/dashboards/admin/home') {
            header('Location: /e5-formation/home');
        }
    }

    public function getNbAdmins()
    {
        global $pdo;
        $sql = "SELECT COUNT(*) as nbAdmins FROM users WHERE role = 'admin'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['nbAdmins'];
    }
    public function getNbProfs()
    {
        global $pdo;
        $sql = "SELECT COUNT(*) as nbProfs FROM users WHERE role = 'enseignant'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['nbProfs'];
    }
    public function getNbEleves()
    {
        global $pdo;
        $sql = "SELECT COUNT(*) as nbEleves FROM users WHERE role = 'eleve'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['nbEleves'];
    }
}
