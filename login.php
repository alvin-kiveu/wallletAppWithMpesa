<?php
session_start();
include 'connection.php';
//CHECK IF USER IS LOGGED IN
if (isset($_SESSION['username'])) {
  echo "<script>window.location.href='index.php?sucess=You are already logged in';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Wallet App || Login</title>
  <link rel="stylesheet" href="styleapp.css">
</head>

<body>
  <div class="container">
    <div class="login form">
      <div class="containerholder">
        <h1>Wallet App Login</h1>
        <form action="include/auth.php" method="POST">
          <?php
          if (isset($_GET['sucess'])) {
            echo "<p style='color:green'>" . $_GET['sucess'] . "</p>";
          } elseif (isset($_GET['error'])) {
            echo "<p style='color:red'>" . $_GET['error'] . "</p>";
          }
          ?>
          <input type="text" name="username" placeholder="Username" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="submit" name="login" class="button" value="LOGIN">
          <a href="register.php">Create New Account</a>
        </form>

      </div>
    </div>
  </div>
</body>

</html>