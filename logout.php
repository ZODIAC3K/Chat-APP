<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
        if(isset($logout_id)){ // Changed from $login_id to $logout_id
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$_SESSION['unique_id']}'"); // Added WHERE clause
            if($sql){
                session_unset();
                session_destroy();
                header("location: ./login.php");
            }
        } else {
            header("location: ./users.php"); // Added colon after "location"
        }
    } else {
        header("location: ./login.php"); // Added colon after "location"
    }
?>
