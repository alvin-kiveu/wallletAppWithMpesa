<?php
include 'header.php';
if (isset($_POST['deposit'])) {
  include 'accessToken.php';
  $amount = $_POST['amount'];
  $accountnumber = $_POST['accountnumber'];
  $phone = $_POST['phone'];
  //CHECK IN FIRST 3 DIGITS IS 254
  $first3digits = substr($phone, 0, 3);
  if($first3digits == '254'){
    $phone = $phone;
  }else{
    $phone = '254'.(int)$phone;
  }
  date_default_timezone_set('Africa/Nairobi');
  $processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  $callbackurl = ''; //Fill with your callback url for stk push use your website url or Ngrok url
  $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
  $BusinessShortCode = '174379';
  $Timestamp = date('YmdHis');
  // ENCRIPT  DATA TO GET PASSWORD
  $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
 //phone number to receive the stk push
  $money =$amount;
  $PartyA = $phone;
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
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
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