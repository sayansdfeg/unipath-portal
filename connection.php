<?php
/**
 * Database Connection Configuration
 * Centralized database connection for the entire application
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'unipath_db');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Create connection
$mysqli = new mysqli(
    DB_HOST,
    DB_USER,
    DB_PASS,
    DB_NAME
);

// Set charset
if (!$mysqli->set_charset(DB_CHARSET)) {
    error_log("Error loading character set " . DB_CHARSET . ": " . $mysqli->error);
    die(json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]));
}

// Check connection
if ($mysqli->connect_error) {
    error_log("Connection error: " . $mysqli->connect_error);
    die(json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $mysqli->connect_error
    ]));
}

/**
 * Helper function to prepare and execute queries safely
 * 
 * @param mysqli $conn Database connection
 * @param string $query SQL query with ? placeholders
 * @param array $params Parameters to bind
 * @param string $types Type string ('s' = string, 'i' = integer, 'd' = double)
 * @return mysqli_result|bool Query result or false on error
 */
function executeQuery($conn, $query, $params = [], $types = '') {
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        error_log("Prepare error: " . $conn->error);
        return false;
    }
    
    if (!empty($params) && !empty($types)) {
        $stmt->bind_param($types, ...$params);
    }
    
    if (!$stmt->execute()) {
        error_log("Execute error: " . $stmt->error);
        return false;
    }
    
    return $stmt->get_result();
}

/**
 * Start session with proper configuration
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => isset($_SERVER['HTTPS']),
        'cookie_samesite' => 'Strict'
    ]);
}

?>
