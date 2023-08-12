<?php 
    while ($row = mysqli_fetch_assoc($sql)) {
        $outgoing_id = $_SESSION['unique_id'];
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']} AND outgoing_msg_id = {$outgoing_id}) OR (incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = {$row['unique_id']}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        if($query2) {
            if(mysqli_num_rows($query2) > 0){
                $row2 = mysqli_fetch_assoc($query2);
                $latest_message = $row2['msg'];
                if ($row2['incoming_msg_id'] == $row['unique_id']) {
                    $latest_message = "You: " . $latest_message;
                }
            } else {
                $latest_message = "No message available";
            }
            
            // Set the offline class based on status
            $offline = ($row['status'] == "Offline now") ? "offline" : "";
            
            $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                <div class="content">
                    <img src="/test/images/' . $row["image"] . '" alt="">
                    <div class="details">
                        <span>' . $row["fname"] . ' ' . $row["lname"] . '</span>
                        <p>'.$latest_message.'</p>
                    </div>
                </div>
                <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
            </a>';
        } else {
            // Handle query error
            echo "Error in query: " . mysqli_error($conn);
        }
    }
?>
