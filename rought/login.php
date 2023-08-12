<?php
// Dummy MySQL database connection
$servername = "localhost";
$username = "zodiac";
$password = "Rockon-30";
$dbname = "dummy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from the request
$data = json_decode(file_get_contents('php://input'), true);
$username = $data["username"];
$password = $data["password"];

// Perform a SELECT query to check if the user exists in the "users" table
$sql = "SELECT full_name FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found, return the user's full name as a JSON response
    $user = $result->fetch_assoc(); // makes relation b/w mysql data array and user{variable}.
    echo json_encode(["full_name" => $user["full_name"]]); // encodes json format with key -? full_name with full_name of data array in relation with user{variable}.
} else {
    // User not found, return an error message as a JSON response
    echo json_encode(["error" => "Invalid username or password."]);
    
}

$conn->close();
?>
