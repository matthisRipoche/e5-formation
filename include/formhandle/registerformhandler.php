<?php
new RegisterForm();

class RegisterForm
{
    public function __construct()
    {
        $this->handle();
    }

    private function handle()
    {
        //dd($_POST);

        if (isset($_POST['loginEmail'])) {
            die;
            $mail = $_POST['LoginEmail'];
            dd('mail : ' . $mail);
        }
    }
}
