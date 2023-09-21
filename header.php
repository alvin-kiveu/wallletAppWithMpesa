<?php
session_start();
include 'connection.php';
//CHECK IF USER IS LOGGED IN
if (!isset($_SESSION['username'])) {
  echo "<script>window.location.href='login.php?error=You need to login first';</script>";
}
$username = $_SESSION['username'];
//GET USER NAME DATA
$getUserName = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
$user = mysqli_fetch_array($getUserName);
$name = $user['name'];
$phone = $user['phone'];
$email = $user['email'];
$getAccountData = mysqli_query($db, "SELECT * FROM  accounbalance");
if (mysqli_num_rows($getAccountData) > 0) {
  $accountData = mysqli_fetch_array($getAccountData);
  $accountBalance = $accountData['balance'];
  if ($accountBalance == "" || $accountBalance == null || empty($accountBalance)) {
    $accountBalance = 0;
  } else {
    $accountBalance = $accountData['balance'];
  }
} else {
  $accountBalance = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Wallet App</title>
  <link rel="stylesheet" href="styleapp.css">
</head>

<body>
  <div class="container">
    <div class="login form">
      <div class="containerholder">
        <h1>Wallet App</h1>

        <div class="accout" id="account">
          <h2>Account Balance</h2>
          <h3>Ksh <?php
                  //ECHO THE BALANCE IN TWO DECIMAL PLACES
                  echo number_format($accountBalance, 2);
                  ?></h3>
        </div>
        <div class="account-panel">
          <div class="account-name">
            <h2><span class='loginuser'>User Logged in : </span><?php echo  $name; ?></h2>
          </div>  
          <div class="account-logout">
            <a href="logout.php?logout">Logout</a>
          </div>
        </div>
        <?php include 'links.php'; ?>
      </div>