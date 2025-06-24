<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body> <!--welkom voor admin -->
    <h1>Welkom, <?php echo $_SESSION['username']; ?> (Admin)</h1>
    <a href="logout.php">Log uit</a>
    <a href="index_crud.php">CRUD Vragen</a>
    <a href="crud_teams/index.php">CRUD Teams</a>
</body>
</html>
