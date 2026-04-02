<!DOCTYPE html>
<html>
<head>
    <title>Program List</title>
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

<h2>Programs</h2>

<a href="index.php?controller=home&action=index">
← Back to Home
</a>
<br><br>

<?php if (in_array($role, ['admin','staff'])): ?>
    <a class="btn" href="index.php?controller=program&action=new">
        Add New Program
    </a>
<?php endif; ?>

<table border="1" cellpadding="8">

<tr>
    <th>Code</th>
    <th>Title</th>
    <th>Years</th>
    <th>Action</th>
</tr>

<?php foreach ($programs as $row): ?>
<tr>
    <td><?= htmlspecialchars($row['code']) ?></td>
    <td><?= htmlspecialchars($row['title']) ?></td>
    <td><?= htmlspecialchars($row['years']) ?></td>

    <td>
        <?php if (in_array($role, ['admin','staff'])): ?>
            <a href="index.php?controller=program&action=edit&program_id=<?= $row['program_id'] ?>">
                Edit
            </a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>