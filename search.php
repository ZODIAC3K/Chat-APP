<?php
session_start();
include_once "config.php";

$json = file_get_contents('php://input');
$data = json_decode($json, true); // Decode the JSON data into an associative array


    $searchTerm = mysqli_real_escape_string($conn, $data['searchTerm']);
    $output = "";
    $sessionUniqueId = $_SESSION['unique_id'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE (fname LIKE '%$searchTerm%' OR lname LIKE '%$searchTerm%') AND unique_id != '$sessionUniqueId'");
    
    if (mysqli_num_rows($sql) > 0) {
        
        include "data.php";

    } else {
        $output = "No users found";
    }
    
    echo $output;
?>
