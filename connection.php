<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'wallet');
try{
  $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
  if(!$db){
    echo "Wallet App not connected to database";
  }else{
    // echo "Wallet App connected to database";
  }
}catch(Exception $e){
  echo $e->getMessage();
}