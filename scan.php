<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['url'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cyber_security";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check for SQL Injection Vulnerabilities
    function checkSQLi($url) {
        $payload = "' OR '1'='1";
        $target = $url . "?id=" . urlencode($payload);

        $response = @file_get_contents($target);
        if ($response === false) {
            return "Unable to connect to the URL for SQL Injection check.";
        }

        if (strpos($response, "syntax") || strpos($response, "SQL")) {
            return "🚨 Potential SQL Injection Vulnerability Found!";
        } else {
            return "✅ No SQL Injection Vulnerability Detected.";
        }
    }

    // Check for XSS Vulnerabilities
    function checkXSS($url) {
        $payload = "<script>alert('XSS')</script>";
        $target = $url . "?q=" . urlencode($payload);

        $response = @file_get_contents($target);
        if ($response === false) {
            return "Unable to connect to the URL for XSS check.";
        }

        if (strpos($response, htmlspecialchars($payload))) {
            return "🚨 Potential XSS Vulnerability Found!";
        } else {
            return "✅ No XSS Vulnerability Detected.";
        }
    }

    // Check HTTP Security Headers
    function checkHeaders($url) {
        $headers = @get_headers($url, 1);
        if ($headers === false) {
            return "Unable to retrieve headers for the given URL.";
        }

        $missingHeaders = [];
        if (!isset($headers['X-Frame-Options'])) {
            $missingHeaders[] = "X-Frame-Options";
        }
        if (!isset($headers['Content-Security-Policy'])) {
            $missingHeaders[] = "Content-Security-Policy";
        }
        if (!isset($headers['X-Content-Type-Options'])) {
            $missingHeaders[] = "X-Content-Type-Options";
        }

        if (empty($missingHeaders)) {
            return "✅ All Important Security Headers Are Present.";
        } else {
            return "🚨 Missing Security Headers: " . implode(", ", $missingHeaders);
        }
    }

    // Check Outdated Server Version
    function checkOutdatedServer($url) {
        $headers = @get_headers($url, 1);
        if ($headers === false) {
            return "Unable to retrieve server information for the given URL.";
        }

        if (isset($headers['Server'])) {
            $serverInfo = is_array($headers['Server']) ? implode(", ", $headers['Server']) : $headers['Server'];

            if (strpos($serverInfo, "Apache/2.2") !== false) {
                return "🚨 Warning: Apache version 2.2 detected, which is outdated and insecure.";
            } else {
                return "✅ Server software appears up-to-date: $serverInfo.";
            }
        } else {
            return "No Server information found in headers.";
        }
    }

    // Get scan results
    $sqliResult = checkSQLi($url);
    $xssResult = checkXSS($url);
    $headersResult = checkHeaders($url);
    $serverResult = checkOutdatedServer($url);

    // Insert scan results into the database
    $stmt = $conn->prepare("INSERT INTO scanned_website (url, sqli_result, xss_result, headers_result, server_result) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $url, $sqliResult, $xssResult, $headersResult, $serverResult);

    if ($stmt->execute()) {
        echo "Scan results stored successfully.";
    } else {
        echo "Error storing scan results: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    // Display Results with Styling
    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Security Scan Results</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #0d1117;
                color: #c9d1d9;
                font-family: "Consolas", monospace;
            }
            .container {
                margin-top: 50px;
                background-color: #161b22;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 255, 0, 0.2);
            }
            h2 {
                color: #58a6ff;
                border-bottom: 2px solid #58a6ff;
                padding-bottom: 10px;
            }
            .result {
                margin: 20px 0;
                padding: 15px;
                border-radius: 5px;
                background-color: #21262d;
            }
            .result strong {
                color: #58a6ff;
            }
            .result .safe {
                color: #3fb950;
            }
            .result .danger {
                color: #f85149;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>🔍 Security Scan Results for: ' . htmlspecialchars($url) . '</h2>
            <div class="result">
                <strong>SQL Injection Check:</strong> <span class="' . (strpos($sqliResult, "🚨") !== false ? "danger" : "safe") . '">' . $sqliResult . '</span>
            </div>
            <div class="result">
                <strong>XSS Check:</strong> <span class="' . (strpos($xssResult, "🚨") !== false ? "danger" : "safe") . '">' . $xssResult . '</span>
            </div>
            <div class="result">
                <strong>Security Headers Check:</strong> <span class="' . (strpos($headersResult, "🚨") !== false ? "danger" : "safe") . '">' . $headersResult . '</span>
            </div>
            <div class="result">
                <strong>Outdated Server Check:</strong> <span class="' . (strpos($serverResult, "🚨") !== false ? "danger" : "safe") . '">' . $serverResult . '</span>
            </div>
        </div>
    </body>
    </html>';
}
?>