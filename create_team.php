<?php
session_start();
require_once('dbcon.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $team_naam = $_POST['team_naam'];
    $aantal_spelers = $_POST['aantal_spelers'];
    
    try {
        $stmt = $db_connection->prepare("INSERT INTO teams (team_naam, aantal_spelers, start_time) VALUES (?, ?, NOW())");
        $stmt->execute([$team_naam, $aantal_spelers]);
        $team_id = $db_connection->lastInsertId();
        
        $_SESSION['team_id'] = $team_id;
        $_SESSION['team_naam'] = $team_naam;
        header("Location: room_1.php?reset=1");
        exit();
    } catch (PDOException $e) {
        $error = "Error creating team: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Team</title>
    <link rel="stylesheet" href="homepage_dreamescape.css">
    <style>
        .team-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            width: 400px;
        }
        
        .team-form input, .team-form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-family: 'lemonmilkmedium';
        }
        
        .team-form button {
            background-color: #2F4159;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="background-container">
        <img src="images/loginbackground.jpg" id="backgroundlogin">
    </div>
    
    <div class="team-form">
        <h2>Create Your Team</h2>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="team_naam" placeholder="Team Name" required>
            <input type="number" name="aantal_spelers" placeholder="Number of Players" min="1" required>
            <button type="submit">Start Game</button>
        </form>
    </div>
</body>
</html>