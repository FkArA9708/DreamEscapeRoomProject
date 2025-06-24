<?php

$conn = new mysqli("localhost", "root", "", "escape-room");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$username = $conn->real_escape_string($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure password hashing


$check = $conn->query("SELECT * FROM users WHERE username = '$username'");
if ($check->num_rows > 0) {
    echo "Username already taken!";
} else {
    
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        echo '<a href="../index_loggedin.php"><button>Go to Home</button></a>';
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
