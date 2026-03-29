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

    <h1>
        Welcome,
        <?= htmlspecialchars($username) ?>
        (<?= htmlspecialchars($role) ?>)
    </h1>

    <h2>School Encoding Module</h2>

    <a class="btn" href="index.php?controller=program&action=list">
        Manage Programs
    </a><br>

    <a class="btn" href="index.php?controller=subject&action=list">
        Manage Subjects
    </a><br>

    <a class="btn" href="index.php?controller=user&action=changePassword">
        Change Password
    </a><br>

    <?php if ($role === 'admin'): ?>
        <a class="btn" href="index.php?controller=user&action=list">
            User Accounts
        </a><br>
    <?php endif; ?>

    <a class="btn" href="index.php?controller=auth&action=logout">
        Logout
    </a>

</div>

</body>
</html>