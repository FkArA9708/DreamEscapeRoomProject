<?php
// auteur: Vul hier je naam in
// functie: verwijder een team op basis van de id
include 'functions.php';

// Haal team uit de database
if(isset($_GET['team_id'])){

    // test of insert gelukt is
    if(deleteRecord($_GET['team_id']) == true){
        echo '<script>alert("team_id: ' . $_GET['team_id'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("Team is NIET verwijderd")</script>';
    }
}
?>

