<?php
$formLogin = new LoginForm();

class LoginForm extends FormValidator
{
    public $error = '';

    public function __construct()
    {
        $this->handle();
    }

    private function handle()
    {
        global $pdo;
        if (isset($_POST['login-submit'])) {

            if ($this->isFormValid($pdo)) {
                $this->loginUser($_POST['login-email'], $pdo);
            }
        }
    }

    private function isFormValid($pdo)
    {
        $email = $_POST['login-email'];
        $password = password_hash($_POST['login-password'], PASSWORD_DEFAULT);

        if (!$this->isEmailExist($email, $pdo)) {
            $this->error = 'Email does not exist';
            return false;
        }

        if ($this->isPasswordCorrect($email, $password, $pdo)) {
            $this->error = 'Password is incorrect';
            return false;
        }

        return true;
    }

    private function loginUser($email, $pdo)
    {
        // Préparation de la requête SQL
        $sql = "SELECT id FROM users WHERE mail = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->execute();
        $user = $stmt->fetch();

        // Vérification si l'utilisateur existe
        if ($user) {
            $user = new User($user['id']);
            session_start();

            $_SESSION['user'] = $user;

            // Redirection après connexion
            header('Location: home');
            exit();
        } else {
            $this->error = 'User not found.';
        }
    }
}
