<?php include 'header.php';
$genQrCode = false;
if (isset($_POST['genarateqrcode'])) {
  include 'accessToken.php';
  $amount = $_POST['amount'];
  $accountNumber = $_POST['accountNumber'];
  $DynamicQRUrl = "https://api.safaricom.co.ke/mpesa/qrcode/v1/generate";
  $MerchantName = "UMESKIA TEST PAY";
  $AccountNumber = "umeskia1234";
  $BusinessShortCode = "600997";
  $MerchantName = "Wallet App";
  $payload = array(
    'MerchantName' => $MerchantName,
    'RefNo' =>  $accountNumber,
    'Amount' =>  $amount,
    'TrxCode' => 'PB',
    'CPI' => $BusinessShortCode,
    'Size' => '300',
  );
  $ch = curl_init();
  curl_setopt_array(
    $ch,
    array(
      CURLOPT_URL => $DynamicQRUrl,
      CURLINFO_HEADER_OUT => true,
      CURLOPT_HTTPHEADER =>  array('Content-Type: application/json', 'Authorization:Bearer ' . $access_token),
      CURLOPT_POST =>  true,
      CURLOPT_POSTFIELDS =>  json_encode($payload),
      CURLOPT_RETURNTRANSFER =>  true,
      CURLOPT_SSL_VERIFYPEER =>  false,
      CURLOPT_SSL_VERIFYHOST =>  false
    )
  );
  $response = curl_exec($ch);
  $resp = json_decode($response);
  $resp->QRCode;
  if (isset($resp->QRCode)) {
    $data =  $resp->QRCode;
    $qrImage = "data:image/jpeg;base64, {$resp->QRCode}";
    $genQrCode = true;
  } else {
    echo "<script>window.location.href='depositviaqrcode.php?error=Something Went Wrong'</script>";
  }
}

if ($genQrCode == true) {
?>
  <form action="#">
    <?php
    echo "<p style='color:green'>Dynamic QR Code Generated Successfully</p>";
    ?>
    <image class="qrcode" src="<?php echo  $qrImage; ?>" alt="QR Code">
  </form>
<?php } else { ?>
  <form action="#" method="POST">
    <?php
    if (isset($_GET['sucess'])) {
      echo "<p style='color:green'>" . $_GET['sucess'] . "</p>";
    } elseif (isset($_GET['error'])) {
      echo "<p style='color:red'>" . $_GET['error'] . "</p>";
    }
    ?>
    <input type="number" name="amount" placeholder="Amount" required>
    <input type="text" name="accountNumber" placeholder="Account Number" required>
    <input type="submit" class="button" name="genarateqrcode" value="GENARATE QR CODE">
  </form>
<?php } ?>
<?php include 'footer.php'; ?>