<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["user_id"])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
include 'config.php';

// Fetch user details from the database
$user_id = $_SESSION["user_id"];
$stmt = $conn->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🔒 Cyber Security Profile 🔒</title>
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
        button {
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
    </style>
</head>
<body>
    <h2>👤 Your Cyber Profile 👤</h2>
    <p>Welcome back, <strong><?php echo htmlspecialchars($username); ?></strong>!</p>
    <p>Your email: <strong><?php echo htmlspecialchars($email); ?></strong></p>

    <!-- Logout Button -->
    <form action="logout.php" method="post">
        <button type="submit">🚪 Logout</button>
    </form>

    <!-- ASCII Art for Fun -->
    <pre>
        .-.-. .-.-. .-.-. .-.-. .-.-. 
        |P|R|O|F|I|L|E| |P|A|G|E| 
        '-'-' '-'-' '-'-' '-'-' '-'-' 
    </pre>
</body>
</html>