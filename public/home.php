<?php
require_once "../core/Autoloader.php";
require_once "../core/Auth.php";
require_login();
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
            text-align: center;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center; 
        }

        .container {
            max-width: 600px;
            margin: 0 auto; 
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
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
        <h2> Welcome, <?= $_SESSION['username'] ?> (<?= $_SESSION['account_type'] ?>)</h2>
        <h1>School Encoding Module</h1>
        
        <a class="btn" href="program_list.php">Manage Programs</a><br>
        <a class="btn" href="subject_list.php">Manage Subjects</a><br>

        <a class="btn" href="change_password.php">Change Password</a><br>
        <?php if ($_SESSION['account_type'] === 'admin'): ?>
            <a class="btn" href="users_list.php">User Accounts</a><br>
        <?php endif; ?>
        <a class="btn" href="logout.php">Logout</a>
    </div>
</body>
</html>