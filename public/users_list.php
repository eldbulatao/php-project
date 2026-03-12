<?php
require_once "../core/Autoloader.php";
require_once "../core/Auth.php";
use App\Models\User;

require_admin();

$userModel = new User();
$users = $userModel->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 40px;
        }

        h1, h2 {
            margin-top: 0;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #8100cc;
            font-weight: bold;
        }

        .top-links { margin-bottom: 15px; }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            background-color: #8100cc;
            color: white;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .btn:hover { background-color: #490464;}

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background-color: #8100cc;
            color: white;
            text-align: left;
            padding: 10px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover { background-color: #f1f1f1; }

        label { font-weight: bold; }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 16px;
            background-color: #8100cc;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover { background-color: #490464; }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Users</h2>
        <div class="top-links">
            <a href="home.php">← Back to Home</a>
        </div>
        <a class="btn" href="users_new.php">Add User</a>

        <table>
        <tr>
            <th>Username</th>
            <th>Account Type</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $u) { ?>
        <tr>
            <td><?= $u['username'] ?></td>
            <td><?= $u['account_type'] ?></td>
            <td><?= $u['created_on'] ?></td>
            <td><?= $u['updated_on'] ?></td>
            <td>
                <?php if ($u['account_type'] !== 'admin'): ?>
                    <a href="users_edit.php?id=<?= $u['id'] ?>">Edit</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php } ?>
        </table>
        
    </div>
</body>
</html>

