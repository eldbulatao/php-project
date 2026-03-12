<?php
require_once "../core/Autoloader.php";
require_once "../core/Auth.php";
use App\Models\Subject;

require_login();

$subjectModel = new Subject();
$subjects = $subjectModel->getAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Subject List</title>
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
        <h2>Subjects</h2>
        <div class="top-links">
            <a href="home.php">← Back to Home</a>
        </div>
        <?php if (in_array($_SESSION['account_type'], ['admin', 'staff'])): ?>
            <a class="btn" href="subject_new.php">Add New Subject</a>
        <?php endif; ?>

        <table>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>

            <?php foreach ($subjects as $row) { ?>
            <tr>
                <td><?= $row['code'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['unit'] ?></td>
                <td>
                    <?php if (in_array($_SESSION['account_type'], ['admin', 'staff'])): ?>
                        <a href="subject_edit.php?subject_id=<?= $row['subject_id'] ?>">Edit</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>