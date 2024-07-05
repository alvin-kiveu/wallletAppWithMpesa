<?php
include 'header.php';
if (isset($_POST['deposit'])) {
  include 'accessToken.php';
  $amount = $_POST['amount'];
  $accountnumber = $_POST['accountnumber'];
  $phone = $_POST['phone'];
  $callbackurl = 'https://'.$_SERVER['HTTP_HOST'].'/test/WalletApp/callback.php';
  //CHECK IN FIRST 3 DIGITS IS 254
  $first3digits = substr($phone, 0, 3);
  if($first3digits == '254'){
    $phone = $phone;
  }else{
    $phone = '254'.(int)$phone;
  }
  date_default_timezone_set('Africa/Nairobi');
  $processrequestUrl = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  $passkey = "84f5203ba829a446e37fe786c9082b6b49d311a55ca6543bfb7dcb3e0e65c459";
  $BusinessShortCode = '7373854';
  $Timestamp = date('YmdHis');
  // ENCRIPT  DATA TO GET PASSWORD
  $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
 //phone number to receive the stk push
  $money = $amount;
  $PartyA = '9331755';
  $PartyB = '254708374149';
  $AccountReference = $accountnumber;
  $TransactionDesc = 'stkpush test';
  $Amount = $money;
  $stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];
  //INITIATE CURL
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); //setting custom header
  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerBuyGoodsOnline',
    'Amount' => $Amount,
    'PartyA' => $phone,
    'PartyB' => '9331755',
    'PhoneNumber' => $phone,
    'CallBackURL' => $callbackurl,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  //ECHO  RESPONSE
  $data = json_decode($curl_response);
  $CheckoutRequestID = $data->CheckoutRequestID;
  $ResponseCode = $data->ResponseCode;
  if ($ResponseCode == "0") {
    echo "<script>window.location.href='index.php?sucess=Plesae Enter Your Mpesa Pin To Complete The Transaction'</script>";
  }else{
    echo "<script>window.location.href='index.php?error=Please Try Again Later'</script>";
  }
}
?>
<form action="#" method="POST">
  <?php
  if(isset($_GET['sucess'])){
    echo "<p style='color:green'>".$_GET['sucess']."</p>";
  }elseif(isset($_GET['error'])){
    echo "<p style='color:red'>".$_GET['error']."</p>";
  }

  ?>


  <input type="number" name="amount" placeholder="Amount" required>
  <input type="text" name="accountnumber" placeholder="Account Number" required>
  <input type="number" name="phone" placeholder="Phone Number" required>
  <input type="submit" name="deposit" class="button" value="Deposit">
</form>
<?php include 'footer.php'; ?>