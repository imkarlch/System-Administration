<?php

include 'db_connection.php';
// Parse XML data
$xml = simplexml_load_file('user.xml');


// Validate and insert data into database
foreach ($xml->user as $user) {
    $user_id = $conn->real_escape_string($user->user_id);
    $username = $conn->real_escape_string($user->username);
    $password = $conn->real_escape_string($user->password);
    $age = $conn->real_escape_string($user->age);
    $email = $conn->real_escape_string($user->email);
    $contact = $conn->real_escape_string($user->contact);
    

    // Check if user ID already exists in the database
    $checkQuery = "SELECT COUNT(*) AS count FROM user WHERE user_id = '$user_id'";
    $checkResult = $conn->query($checkQuery);
    $row = $checkResult->fetch_assoc();
    if ($row['count'] > 0) {
        echo "Error: Duplicate User ID found for User with ID: $user_id. Data was not inserted.";
        continue;
    }

    // Insert data into database
    $sql = "INSERT INTO user (user_id, username, password, age, email, contact) VALUES ('$user_id', '$username', '$password', '$age', '$email', '$contact')";
    if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();

// Redirect back to the HTML page
header("Location: index.php");
exit();
?>
