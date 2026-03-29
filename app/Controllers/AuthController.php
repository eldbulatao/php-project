<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\SessionManager;

class AuthController extends Controller
{
    public function login()
    {
        SessionManager::start();

        if (SessionManager::get('user_id')) {
            $this->redirect("index.php?controller=home&action=index");
        }

        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $username = trim($_POST['username']);
            $password = $_POST['password'];

            if ($username === "" || $password === "") {
                $error = "Username and password are required.";
            } else {

                if (Auth::login($username, $password)) {
                    $this->redirect("index.php?controller=home&action=index");
                } else {
                    $error = "Invalid username or password.";
                }
            }
        }

        $this->view("auth/login", [
            "error" => $error
        ]);
    }

    public function logout()
    {
        SessionManager::destroy();
        $this->redirect("index.php?controller=auth&action=login");
    }
}