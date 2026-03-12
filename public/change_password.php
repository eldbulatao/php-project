<?php
error_reporting(E_ALL & ~E_NOTICE);
require_once "../core/Autoloader.php";
require_once "../core/Auth.php";
use App\Models\User;

require_login();

$userModel = new User();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_new_password'];

    if ($current === "" || $new === "" || $confirm === "") {
        $error = "All fields are required.";
    } else {
        // Get logged in user using model
        $user = $userModel->getById(current_user_id());

        if (!$user || !password_verify($current, $user['password'])) {
            $error = "Current password is incorrect.";
        } elseif (strlen($new) < 6) {
            $error = "New password must be at least 6 characters.";
        } elseif ($new !== $confirm) {
            $error = "New passwords do not match.";
        } else {
            $userModel->changePassword(current_user_id(), $new);
            header("Location: home.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #9b6eb4;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 80px;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #8100cc;
            font-weight: bold;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input {
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

        button:hover {
            background-color: #490464;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Change Password</h2>
    <a href="home.php">← Back to Home</a><br><br>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Current Password</label>
        <input type="password" name="current_password" required>

        <label>New Password</label>
        <input type="password" name="new_password" required>

        <label>Confirm New Password</label>
        <input type="password" name="confirm_new_password" required>

        <button type="submit">Update Password</button>
    </form>
</div>

</body>
</html>