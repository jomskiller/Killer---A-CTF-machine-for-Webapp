<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Content</title>
    <style>
        body {
            background-color: #8b0000; /* Dark red background */
            color: #fff; /* White text color */
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            margin: 0;
        }

        h1 {
            font-size: 3em; /* Larger font size */
            margin-bottom: 20px;
        }

        pre {
            background-color: #2f2f2f; /* Dark gray background for code */
            padding: 20px;
            border-radius: 5px;
            overflow-x: auto;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

<!-- Check /door.php and you might find a way to escape.  -->

    <h1>Run from the killer! you might get caught</h1>
    <?php
   if (isset($_GET['file'])) {
    $file_name = $_GET['file'];

    // Blacklist filenames containing "victim," "door," or "flag",
    $blacklist = ['victim', 'door', 'flag', 'ell'];
    
    foreach ($blacklist as $keyword) {
        if (stripos($file_name, $keyword) !== false) {
            echo "Invalid filename!";
            exit();
        }
    }

    if (file_exists($file_name)) {
        $file_content = file_get_contents($file_name);
        echo "<pre>" . htmlspecialchars($file_content) . "</pre>";
    } else {
        echo "File not found!";
    }
} else {
        echo "Bruteforce the Parameter that will allow you to disclose the source code of this page there might be a clue how we can escape from the Jomskiller";
    }
    ?>
</body>
</html>
