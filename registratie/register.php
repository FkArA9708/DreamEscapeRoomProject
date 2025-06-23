<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "escape-room");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data and sanitize
$username = $conn->real_escape_string($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // secure password hashing

// Check if user already exists
$check = $conn->query("SELECT * FROM users WHERE username = '$username'");
if ($check->num_rows > 0) {
    echo "Username already taken!";
} else {
    // Insert new user
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
