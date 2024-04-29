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

$positions = [ 'QB', 'RB', 'FB', 'C', 'OG', 'OT', 
               'TE', 'WR', 'DT', 'DE', 'LB', 'S', 
               'CB', 'P', 'K', 'PR', 'KR', 'LS'
]
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Players</title>
    <!-- Replace 'static' Flask path with PHP equivalent -->
    <link rel="stylesheet" href="/~bmw032/project_python/static/styles.css">
</head>

<body class="">
    <div id="topnav">
        <!-- Directly link to your PHP or HTML pages -->
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


    <div id="viewplayers">
    <h2>Select Team and Position</h2>
    <form action="/~bmw032/project_python/viewplayershandler.php" method="get">
        <input type="hidden" name="action" value="viewplayers">
        <div class="form-group">
            <label for="team">Team:</label>
            <select id="team" name="team">
                <?php foreach ($teams as $team): ?>
                    <option value="<?= htmlspecialchars($team) ?>"><?= htmlspecialchars($team) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="position">Position:</label>
            <select id="position" name="position">
                <option value="">All</option>
                <?php foreach ($positions as $position): ?>
                    <option value="<?= htmlspecialchars($position) ?>"><?= htmlspecialchars($position) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit">View Players</button>
    </form>
    </div>

    <div id="playerstable">
        <?php if (isset($_SESSION['players']) && is_array($_SESSION['players'])): ?>
        <table>
            <tr>
                <th>Position</th>
                <th>Name</th>
            </tr>
            <?php foreach ($_SESSION['players'] as $player): ?>
            <tr>
                <td><?= htmlspecialchars($player[0]) ?></td>
                <td><?= htmlspecialchars($player[1]) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>No player data available.</p>
        <?php endif; ?>
    </div>


</body>


</html>
