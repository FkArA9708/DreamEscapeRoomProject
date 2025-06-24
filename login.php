<?php
session_start();
include 'dbcon.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['gebruikersnaam'];
    $password = $_POST['wachtwoord'];

    $stmt = $db_connection->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $user['password'] === $password) {
        // login success
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index_loggedin.php");
        }
        exit();
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inlogpagina DreamEscape Furkan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="homepage_dreamescape.css">
</head>
<body>
    <header>
        <nav>
            <div id="navbar_dreamescape">
                <ul>
                    <li><img src="images/DreamEscape.png" alt="logo" id="logonav"></li>
                    <li><a href="room_1.php">Play the game</a></li>
                </ul>
            </div>
        </nav>
    </header>
   <main>
    <div class="background-container">
        <img src="images/loginbackground.jpg" id="backgroundlogin">
    </div>

    <div id="inloggendiv">
        <h1 id="inloggenlabel">Inloggen</h1>

        <?php if ($error != '') echo "<p style='color:red;'>$error</p>"; ?>

        <form method="post" action="">
            <input type="text" name="gebruikersnaam" placeholder="Voer gebruikersnaam in" required><br><br>
            <input type="password" name="wachtwoord" placeholder="Voer wachtwoord in" required><br>
            <input type="submit" id="buttonLogin">
