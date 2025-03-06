<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "user_auth");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = $_POST['password'];

// Fetch user from the database
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        echo "Login successful! Role: " . $user['role'];
        // Redirect based on role
        if ($user['role'] === 'user') {
            header("Location: user_dashboard.html");
        } else {
            header("Location: teacher_dashboard.html");
        }
    } else {
        echo "Invalid password!";
    }
} else {
    echo "User not found!";
}

$conn->close();
?>