<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "user_auth");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
$role = $_POST['role']; // Get the selected role

// Insert user into the database
$sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "Signup successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>