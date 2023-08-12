<?php
session_start();
include_once "config.php";
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id != {$_SESSION['unique_id']}");
$output = "";
$outgoing_id = $_SESSION['unique_id'];
if (mysqli_num_rows($sql) == 0) {
    $output = "No users are available to chat.";
} else {

   include "data.php";
   
}

echo $output;
?>
