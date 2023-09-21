<?php
include 'connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Wallet App || Register</title>
  <link rel="stylesheet" href="styleapp.css">
</head>

<body>
  <div class="container">
    <div class="login form">
      <div class="containerholder">
        <h1>Wallet App Register</h1>
        <form action="include/auth.php" method="POST">
          <?php
          if (isset($_GET['sucess'])) {
            echo "<p style='color:green'>" . $_GET['sucess'] . "</p>";
          } elseif (isset($_GET['error'])) {
            echo "<p style='color:red'>" . $_GET['error'] . "</p>";
          }
          ?>
          <input type="text" name="name" placeholder="Name" required>
          <input type="text" name="username" placeholder="Username" required>
          <input type="email" name="email" placeholder="Email" required>
          <input type="number" name="phone" placeholder="Phone Number" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="password" name="confirmpassword" placeholder="Confirm Password" required>
          <input type="submit" name="register" class="button" value="CREATE ACCOUNT">
          <a href="login.php">Login</a>
        </form>

      </div>
    </div>
  </div>
</body>

</html>