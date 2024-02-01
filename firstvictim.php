<?php
// PHP code to execute the remote PHP code goes here...
$response = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user input
    $url = isset($_POST['url']) ? trim($_POST['url']) : '';

    // Validate input
    if (empty($url) || !filter_var($url, FILTER_VALIDATE_URL)) {
        $response = 'Invalid URL.';
    } else {
        // Attempt to make a GET request
        $content = @file_get_contents($url);

        if ($content !== false) {
            // Execute the retrieved PHP code
            ob_start();
            eval('?>' . $content);
            $response = 'Code executed successfully!';
            $executedResult = ob_get_clean();

            // Return the executed result to the front end
            echo json_encode(['status' => 'success', 'result' => $executedResult]);
            exit();
        } else {
            $response = 'GET request failed. Check the URL format and try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Execute Remote PHP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input, button {
            margin-bottom: 10px;
            padding: 8px;
        }

        button {
            cursor: pointer;
        }

        .response {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to handle form submission using AJAX
            $('form').submit(function(e) {
                e.preventDefault();
                
                // Get the form data
                var formData = $(this).serialize();

                // Make an AJAX request to execute PHP code
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Display the executed result in the front end
                            $('.response').html(response.result);
                        } else {
                            $('.response').html('Error: ' + response.result);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h2>Here is your chance to "EXECUTE" the killer and Get away. The Server only trust itself when accessing the /shell.php?cmd</h2>
        <form>
            <label for="url">Remote PHP URL:</label>
            <input type="text" id="url" name="url">

            <button type="submit">Execute Code</button>
        </form>

        <div class="response"></div>
    </div>
</body>
</html>
