<?php

require_once "../core/Autoloader.php";

use App\Models\User;

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === "" || $password === "") {
        $error = "Username and password are required.";
    } else {

        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['account_type'] = $user['account_type'];

            header("Location: home.php");
            exit();
        }

        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
            max-width: 400px;
            width: 100%;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            text-align: center;
        }

        input {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #8100cc;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>