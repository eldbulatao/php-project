<!DOCTYPE html>
<html>
<head>
    <title>Edit Subject</title>
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
        <h2>Edit Subject</h2>
        <a href="index.php?controller=subject&action=list">← Back to List</a><br><br>

        <?php if ($error) echo "<div class='error'>" . htmlspecialchars($error) . "</div>"; ?>

        <form method="post" action="index.php?controller=subject&action=update">
            <input type="hidden" name="subject_id" value="<?= $subject['subject_id'] ?>">

            <label>Code</label>
            <input type="text" name="code" value="<?= htmlspecialchars($subject['code']) ?>">

            <label>Title</label>
            <input type="text" name="title" value="<?= htmlspecialchars($subject['title']) ?>">

            <label>Unit</label>
            <input type="number" name="unit" value="<?= htmlspecialchars($subject['unit']) ?>">

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>