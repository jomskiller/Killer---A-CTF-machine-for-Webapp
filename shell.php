<?php
// Check if the request is coming from the local IP (127.0.0.1)
if ($_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    header('HTTP/1.0 403 Forbidden');
    echo 'Access forbidden';
    exit;
}

// Continue with the rest of your code for executing shell commands
if (isset($_GET['cmd'])) {
    $cmd = escapeshellcmd($_GET['cmd']);
    $output = shell_exec($cmd);
    echo "<pre>" . htmlspecialchars($output) . "</pre>";
}
?>
