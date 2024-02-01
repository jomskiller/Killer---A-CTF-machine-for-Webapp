<?php
if (isset($_GET['victim'])) {
    $victim_value = $_GET['victim'];

    if ($victim_value == 1) {
        $file_name = 'victim1.php';
    } elseif ($victim_value == 0) {
        header("Location: /firstvictim.php");
        exit(); // Stop further execution
    } else {
        echo "Invalid value for 'victim' parameter!";
        exit(); // Stop further execution
    }

    // Check if the file exists
    if (file_exists($file_name)) {
        // Attempt to include the specified file
        ob_start();
        include $file_name;
        $output = ob_get_clean();

        // Output the content with the bloody design
        echo "<style>
                body {
                    background-color: #8b0000; /* Dark red background */
                    color: #fff; /* White text color */
                    font-family: Arial, sans-serif;
                    text-align: center;
                    padding: 50px;
                    margin: 0;
                }
              </style>";
        echo $output;
    } else {
        echo "File not found!";
    }
} else {
    // Handle the case when 'victim' parameter is not set
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cell</title>
</head>
<body>
    <form method="get" action="">
        <input type="hidden" name="victim" value="1">
        <h1> I WONDER WHERE THIS DOOR WILL LEAD.</h1>
        <button type="submit">Open</button>
    </form>
</body>
</html>
