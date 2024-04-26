<?php
error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 1);
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action']; // A hidden input field in your forms that tells you which form was submitted

    // Based on the action, you collect different data and pass it to the Python script
    switch($action) {
        case 'addgame':
            $gameID = escapeshellarg($_POST['GameID']);
            $team1 = escapeshellarg($_POST['TeamID1']);
            $team2 = escapeshellarg($_POST['TeamID2']);
            $score1 = escapeshellarg($_POST['Score1']);
            $score2 = escapeshellarg($_POST['Score2']);
            $date = escapeshellarg($_POST['date']);

            // Construct the command to run the Python script with the sanitized data
            $command = "python3 main.py $action $gameID $team1 $team2 $score1 $score2 $date";

            // Sanitize the command to prevent command injection
            $command = escapeshellcmd($command);

            // Execute the command and capture the output
            //$output = shell_exec($command);
            $output = system($command);
            file_put_contents('/~bmw032/project_python/logfile.txt', $output, FILE_APPEND);


            // Check the output for success or failure
            if ($output === "success") {
                // If successful, redirect back to the add game page with a success message
                $_SESSION['flash_message'] = "Game added successfully!";
            } else {
                // If failure, redirect back to the add game page with an error message
                $_SESSION['error_message'] = "Failed to add game.";
            }
            break;
        case 'addPlayer':
            // Collect and sanitize 'add player' data
            // Call Python script with the data
            break;
        // Handle other actions as needed
    }

    header('Location: /~bmw032/project_python/' . $action . '.php');
    exit;

} else {
    // If not a POST request, redirect to the home page or show an error
    header('Location: /~bmw032/project_python/home.php');
    exit;
}
?>
