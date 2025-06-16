<?php
    echo "<h1>Insert Vraag</h1>";

    require_once('functions_crud.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertRecord($_POST) == true){
            echo "<script>alert('Vraag is toegevoegd')</script>";
        } else {
            echo '<script>alert("Vraag is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">

        <label for="question">Question:</label>
        <input type="text/number" id="question" name="question" required><br>

        <label for="hint">Hint:</label>
        <input type="text/number" id="hint" name="hint" required><br>

        <label for="answer">Answer:</label>
        <input type="text/number" id="answer" name="answer" required><br>

        <label for="roomId">Room Id:</label>
        <input type="number" id="roomId" name="roomId" required><br>

        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
        <a href='index_crud.php'>Home</a>
    </body>
</html>
