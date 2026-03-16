<?php
require_once __DIR__ . '/../app/Core/Autoloader.php';

use App\Core\Auth;
use App\Models\User;

Auth::requireLogin();

$userModel = new User();
$userId = Auth::userId();
$user = $userModel->getById($userId);

$username = $user['username'] ?? 'Unknown';
$role = $user['account_type'] ?? 'Unknown';
?>

<!DOCTYPE html>
<html>
<head>
    <title>School Encoding Module</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9b6eb4;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            text-align: center;
        }

        h1, h2 {
            margin: 0 0 20px 0;
            color: #333;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background-color: #8100cc;
            color: white;
            border-radius: 4px;
            margin: 8px 0;
            text-decoration: none;
        }

        .btn:hover { background-color: #490464; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($username) ?> (<?= htmlspecialchars($role) ?>)</h1>
        <h2>School Encoding Module</h2>

        <div class="top-links">
            <a class="btn" href="program_list.php">Manage Programs</a><br>
            <a class="btn" href="subject_list.php">Manage Subjects</a><br>
            <a class="btn" href="change_password.php">Change Password</a><br>
            <?php if ($role === 'admin'): ?>
                <a class="btn" href="users_list.php">User Accounts</a><br>
            <?php endif; ?>
            <a class="btn" href="logout.php">Logout</a>
        </div>
    </div>
</body>
</html>