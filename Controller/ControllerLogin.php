<?php

require_once 'Model/User.php';
require_once 'View/View.php';

class ControllerLogin {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function loginPage() {
        $view = new View('Login');
        $view->generate([]);
    }

    public function login($login, $password) {
        $user = $this->user->authenticate($login, $password);
    
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
        } else {
            $view = new View('Login');
            $view->generate(['error' => 'Identifiants incorrects']);
        }
    }

    public function logout() {
        unset($_SESSION['user']);
        header('Location: index.php');
    }
}
