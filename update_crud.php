<?php
    require_once('functions_crud.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updateRecord($_POST) == true){
            echo "<script>alert('Vraag is gewijzigd')</script>";
        } else {
            echo '<script>alert("Vraag is NIET gewijzigd")</script>';
        }
    }

    // Test of id is meegegeven in de URL
    if(isset($_GET['id'])){  
        // Haal alle info van de betreffende id $_GET['id']
        $id = $_GET['id'];
        $row = getRecord($id);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="homepage_dreamescape.css">
  <title>Wijzig Fiets</title>
</head>
<body>
  <h2>Wijzig Fiets</h2>
  <form method="post">
    
    <input type="hidden" id="question" name="id" required value="<?php echo $row['id']; ?>"><br>
    <label for="question">Question:</label>
    <input type="text/number" id="question" name="question" required value="<?php echo $row['question']; ?>"><br>

    <label for="hint">Hint:</label>
    <input type="text/number" id="hint" name="hint" required value="<?php echo $row['hint']; ?>"><br>

    <label for="answer">Answer:</label>
    <input type="number/text" id="answer" name="answer" required value="<?php echo $row['answer']; ?>"><br>

    <label for="roomId">Room Id:</label>
    <input type="number" id="roomId" name="roomId" required value="<?php echo $row['roomId']; ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='index_crud.php'>Home</a>
</body>
</html>

<?php
    } else {
        echo "Geen id opgegeven<br>";
    }
?>