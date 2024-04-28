<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Player</title>
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


    <div id="addplayer">
        <h2>Add Player to a Team</h2>
        <!-- The action must point to a PHP script that handles the POST request -->
        <form action="/~bmw032/project_python/formhandler.php" method="post">
            <input type="hidden" name="action" value="addplayer">
            <!-- <input type="hidden" name="playerID" value="playerID"> -->
            <label for="name">Player Name (First Last)</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="team">Team (Location ONLY i.e. Dallas)</label><br>
            <input type="text" id="TeamID" name="TeamID"><br>
            <label for="position">Position (QB, RB, WR, etc.)</label><br>
            <input type="text" id="postition" name="position"><br>
            <input type="submit" value="Add Player">
        </form>
    </div>
</body>

</html>
