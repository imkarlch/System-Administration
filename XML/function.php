<?php 
include 'db_connection.php';

if (isset($_POST['submit'])) {
    $photo = $_FILES['photo']['name'];
    $tempname = $_FILES['photo']['tmp_name']; // Corrected key from 'tempname' to 'tmp_name'
    $folder = 'Image/'.$photo;

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO image (file) VALUES (?)");
    $stmt->bind_param("s", $photo);

    if ($stmt->execute() && move_uploaded_file($tempname, $folder)) {
        echo "<h2>File Uploaded Successfully</h2>";
    } else {
        echo "<h2>File not Uploaded</h2>";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>


