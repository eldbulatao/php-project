<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function list()
    {
        Auth::requireAdmin();

        $userModel = new User();
        $users = $userModel->getAll();

        $this->view('users/list', [
            'users' => $users
        ]);
    }

    public function new()
    {
        Auth::requireAdmin();

        $userModel = new User();

        $error = "";
        $allowed_types = ['admin','staff','teacher','student'];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $username = trim($_POST['username']);
            $type = $_POST['account_type'] ?? '';
            $pass = $_POST['password'];
            $confirm = $_POST['confirm'];

            if ($username === "" || $pass === "" || $confirm === "" || $type === "") {
                $error = "All fields are required.";
            }
            elseif (!in_array($type,$allowed_types)) {
                $error = "Invalid account type.";
            }
            elseif (strlen($pass) < 6) {
                $error = "Password must be at least 6 characters.";
            }
            elseif ($pass !== $confirm) {
                $error = "Passwords do not match.";
            }
            elseif ($userModel->findByUsername($username)) {
                $error = "Username already exists.";
            }
            else {

                $userModel->create(
                    $username,
                    $pass,
                    $type,
                    Auth::userId()
                );

                $this->redirect(
                    "index.php?controller=user&action=list"
                );
            }
        }

        $this->view('users/new', [
            'error'=>$error,
            'allowed_types'=>$allowed_types
        ]);
    }

    public function edit()
    {
        Auth::requireAdmin();

        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->redirect(
                "index.php?controller=user&action=list"
            );
        }

        $userModel = new User();
        $user = $userModel->getById($id);

        if (!$user) {
            $this->redirect(
                "index.php?controller=user&action=list"
            );
        }

        $error = "";
        $allowed_types = ['admin','staff','teacher','student'];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $username = trim($_POST['username']);
            $type = $_POST['account_type'] ?? '';

            if ($username === "" || $type === "") {
                $error = "All fields are required.";
            }
            elseif (!in_array($type,$allowed_types)) {
                $error = "Invalid account type.";
            }
            else {

                $userModel->update(
                    $id,
                    $username,
                    $type,
                    Auth::userId()
                );

                $this->redirect(
                    "index.php?controller=user&action=list"
                );
            }
        }

        $this->view('users/edit',[
            'user'=>$user,
            'error'=>$error,
            'allowed_types'=>$allowed_types
        ]);
    }

    public function changePassword()
    {
        Auth::requireLogin();

        $userModel = new User();
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $current = $_POST['current_password'];
            $new = $_POST['new_password'];
            $confirm = $_POST['confirm_new_password'];

            $userId = Auth::userId();
            $user = $userModel->getById($userId);

            if ($current === "" || $new === "" || $confirm === "") {
                $error = "All fields are required.";
            }
            elseif (!$user || !password_verify($current,$user['password'])) {
                $error = "Current password is incorrect.";
            }
            elseif (strlen($new) < 6) {
                $error = "New password must be at least 6 characters.";
            }
            elseif ($new !== $confirm) {
                $error = "New passwords do not match.";
            }
            else {

                $userModel->changePassword(
                    $userId,
                    $new,
                    $userId
                );

                $this->redirect(
                    "index.php?controller=home&action=index"
                );
            }
        }

        $this->view('users/change_password',[
            'error'=>$error
        ]);
    }
}