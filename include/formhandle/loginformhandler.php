<?php
new LoginForm();


class LoginForm
{
    public function __construct()
    {
        $this->handle();
    }

    private function handle()
    {
        if (isset($_POST['loginEmail'])) {
            $mail = $_POST['LoginEmail'];
            dd('mail : ' . $mail);
        }
    }
}
