<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add New User Form</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
  </head>
  <body>

      
      <form action="save_to_xml.php" method="post">
        <h3>Please provide the information below</h3> <br>

        <div class="content">

        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" placeholder="User ID" required /><br />

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" required /><br />

        <label for="password">Password:</label>
        <input type="password"  id="password" name="password" placeholder="Password" required/><br />

        <label for="age">Age:</label>
        <input type="number" id="quantity" name="age" min="1" max="99" placeholder="Age" required /><br />

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" placeholder="Email" required /><br />

        <label for="contact">Contact:</label>
        <input type="text" id="contact" name="contact" placeholder="Contact" required /><br>

        <button type="submit">Add User</button>

    </div>

         <div class="form-footer">
    <div class="arrow-icon">
        <a href="table.php"><i class="fa-solid fa-circle-arrow-right fa-beat fa-2xl" style="color: #1B1A55;"></i></a>
    </div>
    </div>
        
      </form>
    
  </body>
</html>
