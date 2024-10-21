
<?php  
$servername = "localhost";
$Username = "root";
$Password = ""; 
$database = "users";

// connection
$conn = new mysqli($servername, $Username, $Password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}