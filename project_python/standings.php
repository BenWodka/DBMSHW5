<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "Errors should be visible now";

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Standings</title>
    <link rel="stylesheet" href="/~bmw032/project_python/static/styles.css">
</head>

<body class="">
    <div id="topnav">
        <a href="/~bmw032/project_python/home.php">Home</a>
        <a href="/~bmw032/project_python/addgame.php">Add Game</a>
        <a href="/~bmw032/project_python/addplayer.php">Add Player</a>
        <a href="/~bmw032/project_python/viewplayers.php">View Players</a>
        <a href="/~bmw032/project_python/standings.php">View Standings</a>
        <a href="/~bmw032/project_python/viewgames.php">View Games by Team</a>
        <a href="/~bmw032/project_python/viewresults.php">View Game Results</a>
    </div>


    <?php if (isset($_SESSION['flash_message'])): ?>
        <div class="alert alert-success">
            <?php echo $_SESSION['flash_message']; ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error_message']; ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>


    <div id="viewstandings">
        <h2>NFL Standings</h2>
        <form action="/~bmw032/project_python/viewplayershandler.php" method="get"> 
        <input type="hidden" name="action" value="viewstandings">
        <button type="submit" style="visibility: hidden;">Load Standings</button>
        </form>
        <table class="standings-table">
            <thead>
                <tr>
                    <th>Conference</th>
                    <th>Team</th>
                    <th>Wins</th>
                    <th>Losses</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($_SESSION['standings'])): ?>
                
                <?php foreach ($_SESSION['standings'] as $standing): ?>
                    <tr>
                            <td><?= htmlspecialchars($standing['Conference']) ?></td>
                            <td><?= htmlspecialchars($standing['Location']) ?> <?= htmlspecialchars($standing['Nickname']) ?></td>
                            <td><?= htmlspecialchars($standing['Wins']) ?></td>
                            <td><?= htmlspecialchars($standing['Losses']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">No standings data available.</td></tr>
                <?php endif; ?>
                <?php
                    // Example PHP code that fetches standings data and populates the table
                    // Each row would be echoed out here based on the fetched data
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
