<?php
// signup.php

session_start();

header('Content-Type: application/json');
include_once "config.php";

// Validate the request method
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}

// Validate the content type
if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];
} else {
    $contentType = '';
}

if (stripos($contentType, 'application/json') === false) {
    echo json_encode(["error" => "Invalid content type. Use application/json"]);
    exit;
}

// Get and decode the JSON data
$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    echo json_encode(["error" => "Invalid JSON data"]);
    exit;
}

$email = $data["email"];
$password = $data["password"];

// Server-side validation
if (empty($email) || empty($password)) {
    echo json_encode(["error" => "All fields are required. Please try again."]);
    exit;
} else {
    // Check for existing email
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, send user data
        $user = $result->fetch_assoc();
        $_SESSION['unique_id'] = $user['unique_id'];
        $status = "Active now";
        $sql2 = "UPDATE users SET status='$status' WHERE unique_id = '{$user['unique_id']}'";
        if ($conn->query($sql2)) {
            echo json_encode(["success" => "Login successful!"]);
        }
    } else {
        echo json_encode(["error" => "Invalid username or password."]);
    }
}

$conn->close(); // Close the database connection
?>
