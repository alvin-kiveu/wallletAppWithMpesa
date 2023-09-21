<?php
session_start();
include '../connection.php';

// REGISTER USER
if (isset($_POST['register'])) {
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $confirmpassword = mysqli_real_escape_string($db, $_POST['confirmpassword']);

  if ($password != $confirmpassword) {
    echo "<script>window.location.href='../register.php?error=Password does not match';</script>";
  } else {
    //CHECK IF USERNAME EXISTS
    $checkusername = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($checkusername) > 0) {
      echo "<script>window.location.href='../register.php?error=Username already exists';</script>";
    } else {
      //CHECK IF EMAIL EXISTS
      $checkemail = mysqli_query($db, "SELECT * FROM users WHERE email = '$email'");
      if (mysqli_num_rows($checkemail) > 0) {
        echo "<script>window.location.href='../register.php?error=Email already exists';</script>";
      } else {
        //CHECK IF PHONE EXISTS
        $checkphone = mysqli_query($db, "SELECT * FROM users WHERE phone = '$phone'");
        if (mysqli_num_rows($checkphone) > 0) {
          echo "<script>window.location.href='../register.php?error=Phone already exists';</script>";
        } else {
          if (strlen($password) < 8) {
            echo "<script>window.location.href='../register.php?error=Password must be at least 8 characters';</script>";
          } else {
            //CHECK THE PHONE NUMBER STARTS WITH 254
            if (substr($phone, 0, 3) != '254') {
              echo "<script>window.location.href='../register.php?error=Phone number must start with 254';</script>";
            } else {
              //CHECK IF PHONE NUMBER IS 12 DIGITS
              if (strlen($phone) != 12) {
                echo "<script>window.location.href='../register.php?error=Phone number must be 12 digits';</script>";
              } else {
                //HASH PASSWORD
                $password = md5($password);
                //INSERT USER INTO DATABASE
                $insertuser = mysqli_query($db, "INSERT INTO users (name, username, email, phone, password) VALUES ('$name', '$username', '$email', '$phone', '$password')");
                if ($insertuser) {
                  echo "<script>window.location.href='../register.php?sucess=Account created successfully';</script>";
                } else {
                  echo "<script>window.location.href='../register.php?error=Error creating account';</script>";
                }
              }
            }
          }
        }
      }
    }
  }
}


// LOGIN USER

if(isset($_POST['login'])){
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $password = md5($password);
  //CHECK IF USERNAME EXISTS
  $checkusername = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
  if(mysqli_num_rows($checkusername) > 0){
    //CHECK IF PASSWORD IS CORRECT
    $checkpassword = mysqli_query($db, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    if(mysqli_num_rows($checkpassword) > 0){
      //LOGIN USER
      $_SESSION['username'] = $username;
      echo "<script>window.location.href='../index.php';</script>";
    }else{
      echo "<script>window.location.href='../login.php?error=Incorrect password';</script>";
    }
  }else{
    echo "<script>window.location.href='../login.php?error=Username does not exist';</script>";
  }
}