<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Debugging output
echo "<pre>Session content: ";
print_r($_SESSION);
echo "</pre>";

// Fetch users
$users = [];
if ($stmt = $conn->prepare("SELECT id, username, email, created_at FROM users")) {
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $users[$row['id']] = $row;
    }
    $stmt->close();
} else {
    die("Users query failed: " . $conn->error);
}

// Fetch scans with debug output
$scans = [];
$query = "SELECT 
    scanned_website.id, 
    scanned_website.user_id, 
    scanned_website.url, 
    scanned_website.sqli_result, 
    scanned_website.xss_result, 
    scanned_website.headers_result, 
    scanned_website.server_result, 
    scanned_website.scan_timestamp 
FROM scanned_website";

if ($stmt = $conn->prepare($query)) {
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<pre>Number of scans found: " . $result->num_rows . "</pre>";
    while ($row = $result->fetch_assoc()) {
        $row['username'] = isset($users[$row['user_id']]) ? $users[$row['user_id']]['username'] : 'Unknown';
        $scans[] = $row;
    }
    $stmt->close();
} else {
    die("Scans query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .scan-details { max-width: 400px; white-space: pre-wrap; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['admin_username'] ?? '') ?>!</h2>
        <a href="logout.php" class="btn btn-danger mb-3">Logout</a>

        <h3>All Users</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($user['username'] ?? '') ?></td>
                        <td><?= htmlspecialchars($user['email'] ?? '') ?></td>
                        <td><?= htmlspecialchars($user['created_at'] ?? '') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Scanned Websites</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>URL</th>
                    <th class="scan-details">Scan Results</th>
                    <th>Scanned At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($scans as $scan): ?>
                    <tr>
                        <td><?= htmlspecialchars($scan['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($scan['username'] ?? 'Unknown') ?></td>
                        <td><?= htmlspecialchars($scan['url'] ?? '') ?></td>
                        <td class="scan-details">
                            <strong>SQLi:</strong> <?= htmlspecialchars($scan['sqli_result'] ?? 'N/A') ?><br>
                            <strong>XSS:</strong> <?= htmlspecialchars($scan['xss_result'] ?? 'N/A') ?><br>
                            <strong>Headers:</strong> <?= htmlspecialchars($scan['headers_result'] ?? 'N/A') ?><br>
                            <strong>Server:</strong> <?= htmlspecialchars($scan['server_result'] ?? 'N/A') ?>
                        </td>
                        <td><?= htmlspecialchars($scan['scan_timestamp'] ?? '') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
