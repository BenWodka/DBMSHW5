<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


// function errorReport($output)
// {
//     // echo getcwd();
//     // file_put_contents('/logfile.txt', $output, FILE_APPEND);

//     // Check the output for success or failure
//     if ($output === "success") {
//         // If successful, redirect back to the add game page with a success message
//         $_SESSION['flash_message'] = "Game added successfully!";
//     } else {
//         // If failure, redirect back to the add game page with an error message
//         $_SESSION['error_message'] = "Failed to add game.";
//     }
// }

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $action = $_GET['action']; // A hidden input field in your forms that tells you which form was submitted

    // Based on the action, you collect different data and pass it to the Python script
    switch($action) {
        case 'viewplayers':
            $team = escapeshellarg($_GET['team']);
            //Checks if user is choosing to filter search with a position
            $position = isset($_GET['position']) && !empty($_GET['position']) && $_GET['position'] !== 'All' ? escapeshellarg($_GET['position']) : '';


            // Construct the command to run the Python script with the sanitized data
            // Construct the command to run the Python script with the sanitized data
            $command = !empty($position) ? 
                "python3 main.py viewposition $team $position" : //if position set, list players from that position
                "python3 main.py viewplayers $team";  //otherwise list all players

               
            var_dump($position);

            // Sanitize the command to prevent command injection
            $command = escapeshellcmd($command);

            echo "<pre>Command: $command</pre>";
            $output = shell_exec($command);
            echo "<pre>Output: $output</pre>";
         

            //errorReport($output);
            if ($output) {
                echo "<pre>players: $players</pre>";
                $players = json_decode($output, true);
                echo "<pre>players after decode: $players</pre>";

                $_SESSION['players'] = $players;
                echo '<pre>Session Data Set: ';
                print_r($_SESSION['players']);
                echo '</pre>';
            } else {
                echo "No output received from Python script.";
            }
            

            
            //print_r($_SESSION['players']);
            session_write_close();

            break;

        case 'viewstandings':
            $command = "python3 main.py viewstandings";
            $command = escapeshellcmd($command);
            $output = shell_exec($command);

            if ($output) {
                //echo "<pre>standings: $output</pre>";
                $standings = json_decode($output, true);

                //echo '<pre>Decoded JSON: '; print_r($standings); echo '</pre>';                print_r($_SESSION['standings']);
                $_SESSION['standings'] = $standings;
                // $_SESSION['standings'] = array(
                //     array("Conference" => "NFC", "Location" => "Arizona", "Nickname" => "Cardinals", "Wins" => 10, "Losses" => 2),
                //     array("Conference" => "AFC", "Location" => "New England", "Nickname" => "Patriots", "Wins" => 12, "Losses" => 1)
                // );
                //echo '<pre>'; print_r($_SESSION['standings']); echo '</pre>';
            } else {
                echo "No output received from Python script.";
            }
            //echo '<pre> after if '; print_r($_SESSION); echo '</pre>';
            session_write_close();

            break;

    }

    header('Location: /~bmw032/project_python/standings.php');
    exit;

} else {
    // If not a GET request, redirect to the home page or show an error
    header('Location: /~bmw032/project_python/home.php');
    exit;
}
ob_end_flush();
?>
