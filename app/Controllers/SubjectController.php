<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\SessionManager;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function list()
    {
        Auth::requireLogin();

        $role = SessionManager::get('account_type') ?? 'guest';

        $subjectModel = new Subject();
        $subjects = $subjectModel->getAll();

        $this->view('subjects/list', [
            'subjects' => $subjects,
            'role' => $role
        ]);
    }

    public function new()
    {
        Auth::requireStaffOrAdmin();

        $subjectModel = new Subject();
        $error = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $code  = trim($_POST["code"]);
            $title = trim($_POST["title"]);
            $unit  = $_POST["unit"];

            if ($code === "" || $title === "") {
                $error = "Code and Title are required.";
            } elseif (!is_numeric($unit) || $unit <= 0) {
                $error = "Unit must be greater than 0.";
            } else {
                $subjectModel->create($code,$title,$unit);

                $this->redirect(
                    "index.php?controller=subject&action=list"
                );
            }
        }

        $this->view('subjects/new', [
            'error' => $error
        ]);
    }

    public function edit()
    {
        Auth::requireStaffOrAdmin();

        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            $this->redirect(
                "index.php?controller=subject&action=list"
            );
        }

        $subjectModel = new Subject();
        $subject = $subjectModel->getById($id);

        if (!$subject) {
            $this->redirect(
                "index.php?controller=subject&action=list"
            );
        }

        $error = "";

        $this->view('subjects/edit', [
            'subject' => $subject,
            'error' => $error
        ]);
    }

    public function update()
    {
        Auth::requireStaffOrAdmin();

        $subjectModel = new Subject();

        $id    = $_POST['subject_id'];
        $code  = trim($_POST['code']);
        $title = trim($_POST['title']);
        $unit  = $_POST['unit'];

        $error = "";

        if ($code === "" || $title === "") {
            $error = "Code and Title are required.";
        } elseif (!is_numeric($unit) || $unit <= 0) {
            $error = "Unit must be greater than 0.";
        } else {

            $subjectModel->update($id,$code,$title,$unit);

            $this->redirect(
                "index.php?controller=subject&action=list"
            );
        }

        $subject = $subjectModel->getById($id);

        $this->view('subjects/edit', [
            'subject'=>$subject,
            'error'=>$error
        ]);
    }
}