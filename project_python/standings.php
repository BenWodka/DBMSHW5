<?php
session_start();
$teams = [
    'Arizona Cardinals',
    'Atlanta Falcons',
    'Baltimore Ravens',
    'Buffalo Bills',
    'Carolina Panthers',
    'Chicago Bears',
    'Cincinnati Bengals',
    'Cleveland Browns',
    'Dallas Cowboys',
    'Denver Broncos',
    'Detroit Lions',
    'Green Bay Packers',
    'Houston Texans',
    'Indianapolis Colts',
    'Jacksonville Jaguars',
    'Kansas City Chiefs',
    'Las Vegas Raiders',
    'Los Angeles Chargers',
    'Los Angeles Rams',
    'Miami Dolphins',
    'Minnesota Vikings',
    'New England Patriots',
    'New Orleans Saints',
    'New York Giants',
    'New York Jets',
    'Philadelphia Eagles',
    'Pittsburgh Steelers',
    'San Francisco 49ers',
    'Seattle Seahawks',
    'Tampa Bay Buccaneers',
    'Tennessee Titans',
    'Washington Commanders'
];

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


    <div id="standings">
        <h2>NFL Standings</h2>
        <table class="standings-table">
            <thead>
                <tr>
                    <th>Conference</th>
                    <th>Team</th>
                    <th>Wins</th>
                    <th>Losses</th>
                    <th>Conference Wins</th>
                    <th>Conference Losses</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($_SESSION['standings']) && !empty($_SESSION['standings'])): ?>
                    <?php foreach ($_SESSION['standings'] as $standing): ?>
                        <tr>
                            <td><?= htmlspecialchars($standing['Conference']) ?></td>
                            <td><?= htmlspecialchars($standing['Location']) ?> <?= htmlspecialchars($standing['Nickname']) ?></td>
                            <td><?= htmlspecialchars($standing['Wins']) ?></td>
                            <td><?= htmlspecialchars($standing['Losses']) ?></td>
                            <td><?= htmlspecialchars($standing['ConferenceWins']) ?></td>
                            <td><?= htmlspecialchars($standing['ConferenceLosses']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No standings data available.</td></tr>
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
