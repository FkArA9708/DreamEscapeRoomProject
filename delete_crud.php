<?php
include 'functions_crud.php';


if(isset($_GET['id'])){

    // test of insert gelukt is
    if(deleteRecord($_GET['id']) == true){
        echo '<script>alert("Vraag: ' . $_GET['id'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index_crud.php'); </script>";
    } else {
        echo '<script>alert("Vraag is NIET verwijderd")</script>';
    }
}
?>

