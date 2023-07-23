<?php
include 'connection.php';
header("Content-Type: application/json");
$stkCallbackResponse = file_get_contents('php://input');
$logFile = "Mpesastkresponse.json";
$log = fopen($logFile, "a");
fwrite($log, $stkCallbackResponse);
fclose($log);
$data = json_decode($stkCallbackResponse);

$MerchantRequestID = $data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
$ResultCode = $data->Body->stkCallback->ResultCode;
$ResultDesc = $data->Body->stkCallback->ResultDesc;
$Amount = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
$TransactionId = $data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
$UserPhoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[4]->Value;
//CHECK IF THE TRASACTION WAS SUCCESSFUL 
if ($ResultCode == 0) {
  $getTheAccoutBalance = mysqli_query($db, "SELECT * FROM accounbalance");
  $row = mysqli_fetch_array($getTheAccoutBalance);
  $balance = $row['balance'];
  $newbalance = $balance + $Amount;
  //UPDATE THE ACCOUNT BALANCE
  mysqli_query($db, "UPDATE accounbalance SET balance='$newbalance'");
  //STORE THE TRANSACTION DETAILS IN THE DATABASE
  mysqli_query($db, "INSERT INTO transactions (MerchantRequestID,CheckoutRequestID,ResultCode,Amount,MpesaReceiptNumber,PhoneNumber) VALUES ('$MerchantRequestID','$CheckoutRequestID','$ResultCode','$Amount','$TransactionId','$UserPhoneNumber')");
}