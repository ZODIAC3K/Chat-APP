<?php
session_start();

if (isset($_SESSION['unique_id'])) {
    include_once "config.php";
    $data = json_decode(file_get_contents('php://input'), true);

    if (!empty($data['message'])) {
        $incoming_id = mysqli_real_escape_string($conn, $data['incoming_id']);
        $outgoing_id = mysqli_real_escape_string($conn, $data['outgoing_id']);
        $message = mysqli_real_escape_string($conn, $data['message']);

        $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES ('$incoming_id', '$outgoing_id', '$message')";
        $query = mysqli_query($conn, $sql);
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => "Empty message"));
    }
} else {
    header("location: /test/login.php");
}
?>
