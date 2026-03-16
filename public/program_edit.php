<?php
require_once __DIR__ . '/../app/Core/Autoloader.php';

use App\Core\Auth;
use App\Core\SessionManager;
use App\Models\Program;

Auth::requireStaffOrAdmin();

$role = SessionManager::get('account_type') ?? 'guest';

$programModel = new Program();
$error = "";

$id = $_GET['program_id'] ?? null;

if (!$id || !is_numeric($id)) {
    header("Location: program_list.php");
    exit();
}

$program = $programModel->getById($id);

if (!$program) {
    header("Location: program_list.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code  = trim($_POST["code"]);
    $title = trim($_POST["title"]);
    $years = $_POST["years"];

    if ($code === "" || $title === "") {
        $error = "Code and Title are required.";
    } elseif (!is_numeric($years) || $years < 1 || $years > 6) {
        $error = "Years must be between 1 and 6.";
    } else {
        $programModel->update($id, $code, $title, $years);
        header("Location: program_list.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Program</title>
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
        <h2>Edit Program</h2>
        <a href="program_list.php">← Back to List</a><br><br>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post">
            <label>Code</label>
            <input type="text" name="code" value="<?= htmlspecialchars($_POST['code'] ?? $program['code']) ?>">

            <label>Title</label>
            <input type="text" name="title" value="<?= htmlspecialchars($_POST['title'] ?? $program['title']) ?>">

            <label>Years</label>
            <input type="number" name="years" value="<?= htmlspecialchars($_POST['years'] ?? $program['years']) ?>">

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>