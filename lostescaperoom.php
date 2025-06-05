<?php require_once 'dbcon.php'; ?>

<?php
session_start();
unset($_SESSION['start_time']);
?>


<html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="homepage_dreamescape.css"> <br>
    <title>Lostescaperoom</title>
</head>
<body>
    <header>
    <img src="../DreamEscapeRoomProject/images/youlose.jpg" alt="youlost" id="backgroundimageyoulost">

    <p id="youlost">You lost! Try again?</p>

    <div id="button1">
    <a href="room_1.php?reset=1" class="button" id="room1link">Room 1</a>

    </div>

    <div id="button2">
    <a href="room_2.php" id="room2link">Room 2</a>
    </div>
</header>
</body>
<html>