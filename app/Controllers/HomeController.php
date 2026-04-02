<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        Auth::requireLogin();

        $userModel = new User();

        $userId = Auth::userId();
        $user = $userModel->getById($userId);

        $this->view('home/index', [
            'username' => $user['username'] ?? 'Unknown',
            'role' => $user['account_type'] ?? 'Unknown'
        ]);
    }
}