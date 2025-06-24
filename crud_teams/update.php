<?php
    // functie: update Team
    // auteur: Vul hier je naam in

    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updateRecord($_POST) == true){
            echo "<script>alert('Team is gewijzigd')</script>";
        } else {
            echo '<script>alert("Team is NIET gewijzigd")</script>';
        }
    }

    // Test of id is meegegeven in de URL
    if(isset($_GET['team_id'])){  
        
        $team_id = $_GET['team_id'];
        $row = getRecord($team_id);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig Team</title>
</head>
<body>
  <h2>Wijzig Team</h2>
  <form method="post">
    
    <input type="hidden" id="team_id" name="team_id" required value="<?php echo $row['team_id']; ?>"><br>
    <label for="team_naam">Team naam:</label>
    <input type="text" id="team_naam" name="team_naam" required value="<?php echo $row['team_naam']; ?>"><br>

    <label for="aantal_spelers">Aantal spelers:</label>
    <input type="number" id="aantal_spelers" name="aantal_spelers" required value="<?php echo $row['aantal_spelers']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>

<?php
    } else {
        echo "Geen id opgegeven<br>";
    }
?>