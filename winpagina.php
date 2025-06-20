<?php
session_start();
require_once('dbcon.php');

// Save end time to database
if (isset($_SESSION['team_id'])) {
    $stmt = $db_connection->prepare("UPDATE teams SET end_time = NOW(), klaar = 1 WHERE team_id = ?");
    $stmt->execute([$_SESSION['team_id']]);
    
    // Reset session for next game
    session_destroy();
    session_start(); // Start new session for navigation
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Congrats</title>
</head>
<body>
  <div class="bgwin"></div>

  <div class="content">
    <h1>Congratulations, <?= isset($_SESSION['team_naam']) ? $_SESSION['team_naam'] : 'Team' ?>!</h1>
    <p>You've escaped the dream world!</p>

    <div class="buttons">
      <a href="create_team.php" class="button_room">Play Again</a>
      <a href="index.html" class="button_room">Go Home</a>
    </div>
  </div>
</body>
</html>