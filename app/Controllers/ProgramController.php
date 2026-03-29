<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\SessionManager;
use App\Models\Program;

class ProgramController extends Controller
{
    public function list()
    {
        Auth::requireLogin();

        $role = SessionManager::get('account_type') ?? 'guest';

        $programModel = new Program();
        $programs = $programModel->getAll();

        $this->view('programs/list', [
            'programs' => $programs,
            'role' => $role
        ]);
    }

    public function new()
    {
        Auth::requireStaffOrAdmin();

        $programModel = new Program();
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $code  = trim($_POST["code"]);
            $title = trim($_POST["title"]);
            $years = $_POST["years"];

            if ($code === "" || $title === "") {
                $error = "Code and Title are required.";
            } elseif (!is_numeric($years) || $years < 1 || $years > 6) {
                $error = "Years must be between 1 and 6.";
            } else {

                $programModel->create($code, $title, $years);

                header("Location: index.php?controller=program&action=list");
                exit;
            }
        }

        $this->view('programs/new', [
            'error' => $error
        ]);
    }

    public function edit()
    {
        Auth::requireStaffOrAdmin();

        $id = $_GET['program_id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $this->redirect("index.php?controller=program&action=list");
        }

        $programModel = new Program();
        $program = $programModel->getById($id);

        if (!$program) {
            $this->redirect("index.php?controller=program&action=list");
        }

        $this->view('programs/edit', [
            'program' => $program,
            'error' => ''
        ]);
    }

    public function update()
    {
        Auth::requireStaffOrAdmin();

        $programModel = new Program();

        $id = $_POST['program_id'];
        $code  = trim($_POST['code']);
        $title = trim($_POST['title']);
        $years = $_POST['years'];

        $error = "";

        if ($code === "" || $title === "") {
            $error = "Code and Title are required.";
        } elseif (!is_numeric($years) || $years < 1 || $years > 6) {
            $error = "Years must be between 1 and 6.";
        } else {
            $programModel->update($id, $code, $title, $years);

            $this->redirect("index.php?controller=program&action=list");
        }

        $program = $programModel->getById($id);

        $this->view('programs/edit', [
            'program' => $program,
            'error' => $error
        ]);
    }
}