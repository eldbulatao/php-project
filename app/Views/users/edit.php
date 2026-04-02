<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
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
    <h2>Edit User</h2>
    <a href="index.php?controller=user&action=list">← Back to List</a><br><br>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?controller=user&action=edit&id=<?= $user['id'] ?>">
        <label>Username</label>
        <input type="text" name="username" 
               value="<?= isset($username) ? htmlspecialchars($username) : htmlspecialchars($user['username']) ?>" required>

        <label>Account Type</label>
        <select name="account_type" required>
            <?php foreach ($allowed_types as $role): ?>
                <option value="<?= $role ?>" 
                    <?= ((isset($type) && $type === $role) || (!isset($type) && $user['account_type'] === $role)) ? 'selected' : '' ?>>
                    <?= ucfirst($role) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>