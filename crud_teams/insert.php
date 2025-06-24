<?php
    // functie: formulier en database insert team
    // auteur: Vul hier je naam in

    echo "<h1>Insert Team</h1>";
    echo "<a href='index.php'> Terug </a>";

    require_once('functions.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertRecord($_POST) == true){
            echo "<script>alert('Team is toegevoegd')</script>";
        } else {
            echo '<script>alert("Team is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">
            <label for="team_naam">Team naam:</label>
            <input type="text" id="team_naam" name="team_naam" required><br>

            <label for="aantal_spelers">Aantal spelers:</label>
            <input type="number" id="aantal_spelers" name="aantal_spelers" required><br>

            <br><br>
            <input type="submit" name="btn_ins" value="Insert">
        </form>
