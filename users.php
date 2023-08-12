<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location: /test/login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat App | Harsh Deepanshu</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<?php
include_once "config.php";
$sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
}
?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img src="/test/images/<?php echo $row['image']?>" alt="">
                    <div class="details">
                        <span><?php echo $row['fname']." ".$row['lname'] ?></span>
                        <p><?php echo $row['status']?></p>
                    </div>
                </div>
                <a href="/test/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
            </div>
        </section>
    </div>
    <script src="/test/javascript/users.js"></script>
</body>
</html>