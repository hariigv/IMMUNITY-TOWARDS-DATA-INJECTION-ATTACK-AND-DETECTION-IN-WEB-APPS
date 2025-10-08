<?php
session_start();
include 'config.php'; // Ensure this file has secure database credentials!

// Check if the request method is POST (secure form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user inputs to prevent XSS and SQL injection
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"]; // Password will be hashed, no need to sanitize

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    if (!$stmt) {
        die("SQL Error: " . $conn->error); // Log errors instead of displaying them in production
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        // Verify the password against the hashed password in the database
        if (password_verify($password, $hashed_password)) {
            // Password is correct! Start a secure session
            $_SESSION["user_id"] = $id;
            $_SESSION["username"] = $username;

            // Regenerate session ID to prevent session fixation attacks
            session_regenerate_id(true);

            // Redirect to the dashboard
            header("Location: index.php");
            exit();
        } else {
            // Invalid password (don't give too much info to attackers!)
            echo "⚠️ Access Denied: Invalid credentials! ⚠️";
        }
    } else {
        // No account found, redirect to registration page
        header("Location: register.php?error=No account found. Please register.");
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔒 Cyber Security Login 🔒</title>
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
    <h2>🔐 Login to the Cyber Realm 🔐</h2>
    <form action="login.php" method="post">
        <input type="email" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <button type="submit">🚪 Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">🚀 Register here</a></p>

    <!-- ASCII Art for Fun -->
    <pre>
        .-.-. .-.-. .-.-. .-.-. .-.-. 
        |H|A|C|K|E|R| |L|O|G|I|N| 
        '-'-' '-'-' '-'-' '-'-' '-'-' 
    </pre>
</body>
</html>