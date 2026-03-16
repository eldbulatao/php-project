<?php
require_once __DIR__ . '/../app/Core/Autoloader.php';

use App\Core\Auth;
use App\Models\User;

Auth::requireAdmin();

$userModel = new User();

$error = "";
$allowed_types = ['admin', 'staff', 'teacher', 'student'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $type = $_POST['account_type'] ?? '';
    $pass = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($username === "" || $pass === "" || $confirm === "" || $type === "") {
        $error = "All fields are required.";
    } elseif (!in_array($type, $allowed_types)) {
        $error = "Invalid account type.";
    } elseif (strlen($pass) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif ($pass !== $confirm) {
        $error = "Passwords do not match.";
    } elseif ($userModel->findByUsername($username)) {
        $error = "Username already exists.";
    } else {
        $userModel->create(
            $username,
            $pass,
            $type,
            Auth::userId()
        );
        header("Location: users_list.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>New User</title>
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

        input, select {
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
    <h2>Add New User</h2>
    <a href="users_list.php">← Back to List</a><br><br>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post">
        <label>Username</label>
        <input type="text" name="username" value="<?= isset($username) ? htmlspecialchars($username) : '' ?>" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Confirm Password</label>
        <input type="password" name="confirm" required>

        <label>Account Type</label>
        <select name="account_type" required>
            <option value="">-- Select Role --</option>
            <?php foreach ($allowed_types as $role): ?>
                <option value="<?= $role ?>" <?= (isset($type) && $type === $role) ? 'selected' : '' ?>>
                    <?= ucfirst($role) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Save</button>
    </form>
</div>
</body>
</html>
