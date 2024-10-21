<?php 
include 'db_connection.php';

if (isset($_POST['submit'])) {
    if(isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])){
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name']; 
        $folder = 'images/'.$file_name;

        // Check if an image already exists in the database
        $existing_image_query = mysqli_query($conn, "SELECT file FROM images LIMIT 1");
        $existing_image_row = mysqli_fetch_assoc($existing_image_query);
        if ($existing_image_row) {
            // Delete existing image file from server
            $existing_file = 'images/'.$existing_image_row['file'];
            if (file_exists($existing_file) && !is_dir($existing_file)) { // Check if it's a file
                unlink($existing_file);
            }

            // Update existing record in database
            $update_query = mysqli_query($conn, "UPDATE images SET file='$file_name' WHERE file='{$existing_image_row['file']}'");
        } else {
            // Insert new record into database
            $query = mysqli_query($conn, "INSERT INTO images (file) VALUES ('$file_name')");
        }

        // Move uploaded file to the folder
        if (move_uploaded_file($tempname, $folder)) {
            echo "<h2>File Uploaded Successfully</h2>";  
        } else {
            echo "<h2>File not Uploaded</h2>";
        }
    } else {
        echo "<h2>Please select an image</h2>";
    }
}

if (isset($_POST['delete'])) {
    $file_name = $_POST['delete'];
    $file_path = 'images/'.$file_name;

    // Delete record from database
    $delete_query = mysqli_query($conn, "DELETE FROM images WHERE file='$file_name'");

    if ($delete_query) {
        // Delete image file from server
        if (file_exists($file_path) && !is_dir($file_path)) { // Check if it's a file
            unlink($file_path); // Deletes the file
            echo "<h2>Image deleted successfully</h2>";
        } else {
            echo "<h2>Image file not found</h2>";
        }
    } else {
        echo "<h2>Error deleting image</h2>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Photo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <style>
        img {
            width: 2in;
            height: 2in;
            object-fit: cover; /* Ensures the image covers the entire area */
            margin: 10px; /* Adds some spacing around images */
            border-radius: 100px;
        }
    </style>
</head>
<body>

    <div id="imageContainer">
        <?php 
        $res = mysqli_query($conn, "SELECT * FROM images");
        while($row = mysqli_fetch_assoc($res)) {
        ?>
        <img src="images/<?php echo $row['file'] ?>" >
        <!-- Add delete button for each image -->
        <form method="post">
            <input type="hidden" name="delete" value="<?php echo $row['file']; ?>">
            <button type="submit" name="delete_submit"><i class="fa-solid fa-trash" style="color: #fc0328;"></i>
            </button>
        </form>
        <?php  
        }?>
    </div>

    <form id="uploadForm" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image" onchange="previewImage(event)">
        <img id="imagePreview" src="#" alt="Preview" style="display: none;">
        
        <div>
        <label>Name:</label>
        <input type="text" name="name" placeholder="Name">

        <label>Address:</label>
        <input type="text" name="address" placeholder="Address"> 

        <label>Age:</label>
        <input type="text" name="age" placeholder="Age">

        <label>Gender:</label>
        <input type="text" name="gender" placeholder="Gender">
    </div>
        <button type="submit" name="submit">Save</button>
    </form>

    


    

    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
                var img = document.getElementById('imagePreview');
                img.src = reader.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>

</body>
</html>
