<?php

class User
{
    public $id;
    private $firstname;
    private $lastname;
    private $email;
    private $hashedPassword;
    private $role;
    private $classe;

    public function __construct($userid)
    {
        $this->id = $userid;
        $this->loadUser();
    }

    private function loadUser()
    {
        global $pdo;
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch();

        if (!$user) {
            throw new Exception('User not found');
        }

        $this->firstname = $user['firstname'];
        $this->lastname = $user['lastname'];
        $this->email = $user['mail'];
        $this->hashedPassword = $user['password'];

        if (isset($user['role'])) {
            $this->role = $user['role'];
        }

        if (isset($user['classe'])) {
            $this->classe = new Classe($user['classe']);
        }
    }

    // Getters ans Setters

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getHashedPassword()
    {
        return $this->hashedPassword;
    }

    public function setHashedPassword($hashedPassword)
    {
        $this->hashedPassword = $hashedPassword;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getClasse()
    {
        return $this->classe;
    }

    public function setClasse($classe)
    {
        $this->classe = $classe;
    }
}
