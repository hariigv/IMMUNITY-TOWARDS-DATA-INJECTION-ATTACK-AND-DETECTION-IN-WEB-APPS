<?php
session_start();
include 'config.php'; // Ensure this file has secure database credentials!

// Check if the request method is POST (secure form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user inputs to prevent XSS and SQL injection
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password securely

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("SQL Error: " . $conn->error); // Log errors instead of displaying them in production
    }
    $stmt->bind_param("sss", $username, $email, $password);

    // Execute the statement and handle the result
    if ($stmt->execute()) {
        // Registration successful! Redirect to login page with a success message
        header("Location: login.php?message=Registration successful! Please log in.");
        exit();
    } else {
        // Display a generic error message (avoid leaking sensitive info)
        echo "⚠️ Error: Something went wrong. Please try again later. ⚠️";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔒 Cyber Security Register 🔒</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            background-color: #0d0d0d;
            color: #00ff00;
            text-align: center;
            padding: 180px;
        }
        h2 {
            color: #00ff00;
            text-shadow: 0 0 5px #00ff00;
        }
        input, button {
            padding: 10px;
            margin: 10px;
            border: 1px solid #00ff00;
            background-color: #1a1a1a;
            color: #00ff00;
        }
        button:hover {
            background-color: #00ff00;
            color: #0d0d0d;
            cursor: pointer;
        }
        a {
            color: #00ff00;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>🔐 Register for the Cyber Realm 🔐</h2>
    <form action="register.php" method="post">
        <input type="text" name="username" placeholder="Enter your username" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <button type="submit">🚀 Register</button>
    </form>
    <p>Already have an account? <a href="login.php">🚪 Login here</a></p>

    <!-- ASCII Art for Fun -->
    <pre>
        .-.-. .-.-. .-.-. .-.-. .-.-. 
        |H|A|C|K|E|R| |R|E|G|I|S|T|E|R| 
        '-'-' '-'-' '-'-' '-'-' '-'-' 
    </pre>
</body>
</html>