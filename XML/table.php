<?php
include 'db_connection.php';

$sql = "SELECT user_id, username, password, age, email, contact FROM user";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" type="text/css" href="table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<body>

	 <a href="index.php"><i class='fas fa-arrow-alt-circle-left' style='font-size:36px'></i></a>
        

    <h1>User List</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr onclick='showDetails(this)'>
                            <td>{$row['user_id']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['password']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['contact']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>User details</h2>
            <p id="userDetails"></p>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        
        function showDetails(row) {
            var cells = row.getElementsByTagName("td");
            var details = `
                <strong>User ID:</strong> ${cells[0].innerText}<br>
                <strong>Username:</strong> ${cells[1].innerText}<br>
                <strong>Password:</strong> ${cells[2].innerText}<br>
                <strong>Age:</strong> ${cells[3].innerText}<br>
                <strong>Email:</strong> ${cells[4].innerText}<br>
                <strong>Contact:</strong> ${cells[5].innerText}<br>
            `;
            document.getElementById("userDetails").innerHTML = details;
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
