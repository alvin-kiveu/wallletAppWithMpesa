<?php
include 'connection.php';
$getAccountData = mysqli_query($db, "SELECT * FROM  accounbalance");
if(mysqli_num_rows($getAccountData) > 0){
$accountData = mysqli_fetch_array($getAccountData);
$accountBalance = $accountData['balance'];
if($accountBalance == "" || $accountBalance == null || empty($accountBalance)){
  $accountBalance = 0;
}else{
  $accountBalance = $accountData['balance'];
}
}else{
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
  <link rel="stylesheet" href="style.css">
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
       <?php include 'links.php'; ?>
      </div>