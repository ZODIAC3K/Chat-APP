<?php
// signup.php
header('Content-Type: application/json');
include_once "config.php";

// Validate the request method
if ($_SERVER["REQUEST_METHOD"] !== "POST") 
{
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}

// Validate the content type
if (isset($_SERVER["CONTENT_TYPE"]) && stripos($_SERVER["CONTENT_TYPE"], 'application/json') === false) 
{
    echo json_encode(["error" => "Invalid content type. Use application/json"]);
    exit;
}

// Get and decode the JSON data
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data["fname"]) || !isset($data["lname"]) || !isset($data["email"]) || !isset($data["password"]) || !isset($data["image"])) 
{
    echo json_encode(["error" => "Invalid JSON data. Make sure all fields are provided."]);
    exit;
}

$fname = $data["fname"];
$lname = $data["lname"];
$email = $data["email"];
$password = $data["password"];
$imageBase64 = $data["image"]; // Base64 image data

// Server-side validation
if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($imageBase64)) 
{
    echo json_encode(["error" => "All fields are required (including Image). Please try again."]);
    exit;
}

// Check for existing email
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);



if ($result === false) 
{
    // Error handling for SQL query
    echo json_encode(["error" => "Error executing SQL query: " .  mysqli_error($conn)]);
    exit;
}

if ($result->num_rows > 0) 
{
    // User found, send Error message!
    echo json_encode(["error" => "Email already exists"]);
    exit;
} else {
    // Decode base64 image data to binary
    $imageData = base64_decode($imageBase64);

    // Get image extension from base64 image data
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $extension = '';
    switch ($finfo->buffer($imageData)) 
    {
        case 'image/jpeg':
            $extension = 'jpg';
            break;
        case 'image/png':
            $extension = 'png';
            break;
        case 'image/gif':
            $extension = 'gif';
            break;
        // Add more cases for other supported image formats (e.g., 'image/bmp', 'image/webp', etc.)
        default:
            echo json_encode(["error" => "Unsupported image format"]);
            exit;
    }

    // Generate a unique image name based on email and current time
    $imageName = $fname . '_' . uniqid() . '.' . $extension;

    // Save the binary image data to a file
    $fileDestination = 'images/';
    $imagePath = $fileDestination . $imageName;
    if (file_put_contents($imagePath, $imageData)) 
    {
        $status = "Active Now";
        $random_id = rand(time(), 10000);
        $sql = "INSERT INTO users (unique_id, fname, lname, email, password, image, status) 
                VALUES ('$random_id', '$fname', '$lname', '$email', '$password', '$imageName', '$status')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["success" => "Registration successful!"]);
        } else {
            // Error handling for SQL query
            echo json_encode(["error" => "Error saving data to the database"]);
        }
    } else 
    {
        // Error handling for file saving
        echo json_encode(["error" => "Error saving the image"]);
    }
}

$conn->close(); // Close the database connection
?>
