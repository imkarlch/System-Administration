<?php
// Get form data
$user_id = $_POST['user_id'];
$username = $_POST['username'];
$password = $_POST['password'];
$age = $_POST['age'];
$email = $_POST['email'];
$contact = $_POST['contact'];

// Load existing XML file or create a new one
$xml = file_exists('user.xml') ? simplexml_load_file('user.xml') : new SimpleXMLElement('<users></users>');

// Check if book ID already exists
$userexist = false;
foreach ($xml->user as $user) {
    if ((string)$user->user_id === $user_id) {
        $userexist = true;
        break;
    }
}

// If book ID already exists, display warning message and redirect
if ($userexist) {
    echo "<script>alert('User ID already exists. Data was not saved.'); window.location.href = 'index.php';</script>";
    exit();
}

// Add new book to XML
$user = $xml->addChild('user');
$user->addChild('user_id', $user_id); // Add book ID
$user->addChild('username', $username);
$user->addChild('password', $password);
$user->addChild('age', $age);
$user->addChild('email', $email);
$user->addChild('contact', $contact);

// Save XML to file
$xml->asXML('user.xml');

// Display success message and redirect
echo "<script>alert('Your data has been added successfully.'); window.location.href = 'save_to_db.php';</script>";
exit();
?>
