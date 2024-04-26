<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Game</title>
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

    <!-- PHP for displaying messages -->
    <!-- PHP for displaying messages -->
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


    <div id="addgame">
        <h2>Add Game to Database</h2>
        <!-- The action must point to a PHP script that handles the POST request -->
        <form action="/~bmw032/project_python/formhandler.php" method="post">
            <input type="hidden" name="action" value="addgame">
            <input type="hidden" name="GameID" value="GameID">
            <label for="team1">Team 1 (Location Only)</label><br>
            <input type="text" id="team1" name="TeamID1"><br>
            <label for="team2">Team 2 (Location Only)</label><br>
            <input type="text" id="team2" name="TeamID2"><br>
            <label for="score1">Score 1</label><br>
            <input type="text" id="score1" name="Score1"><br>
            <label for="score2">Score 2</label><br>
            <input type="text" id="score2" name="Score2"><br>
            <label for="date">Date YYYY-MM-DD</label><br>
            <input type="text" id="date" name="date"><br>
            <input type="submit" value="Add Game">
        </form>
    </div>
</body>

</html>
