<?php
$formRegister = new RegisterForm();

class RegisterForm extends FormValidator
{
    public $error = '';

    public function __construct()
    {
        $this->handle();
    }

    private function handle()
    {
        if (isset($_POST['register-submit'])) {
            if ($this->formIsValid()) {
                $this->registerUser();
            }
        }
    }

    private function formIsValid()
    {
        global $pdo;
        $email = $_POST['register-email'];
        $password = $_POST['register-password'];
        $confirmPassword = $_POST['register-confirmpassword'];

        if ($this->isEmailExist($email, $pdo)) {
            $this->error = 'Email already exist';
            return false;
        }

        if (!$this->isSamePasswordConfirmed($password, $confirmPassword)) {
            $this->error = 'Passwords are not the same';
            return false;
        }

        return true;
    }

    private function registerUser()
    {
        global $pdo;
        $firstname = $_POST['register-firstname'];
        $lastname = $_POST['register-lastname'];
        $email = $_POST['register-email'];
        $password = password_hash($_POST['register-password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];
        $classe = $_POST['classe'];

        // Préparation de la requête SQL
        $sql = "INSERT INTO users (firstname, lastname, mail, password, role, classe) VALUES (:firstname, :lastname, :email, :password, :role, :classe)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->bindParam(':classe', $classe, PDO::PARAM_INT);


        // Exécution de la requête
        $stmt->execute();

        // Redirection
        header('Location: home?page=user');
    }
}
