<?php include 'header.php'; ?>
<div class="tableholder">
  <table>
    <thead>
      <tr>
        <th>No.</th>
        <th>MerchantRequestID</th>
        <th>CheckoutRequestID</th>
        <th>Amount</th>
        <th>Transaction ID</th>
        <th>PhoneNumberr</th>
      </tr>
    </thead>
    <tbody>
     <?php
     $getTransaction = mysqli_query($db, "SELECT * FROM transactions");
     if(mysqli_num_rows($getTransaction) > 0){
        $i = 0;
        while($row = mysqli_fetch_array($getTransaction)){
          $i++;
          echo "<tr>";
          echo "<td>".$i."</td>";
          echo "<td>".$row['MerchantRequestID']."</td>";
          echo "<td>".$row['CheckoutRequestID']."</td>";
          echo "<td>".$row['Amount']."</td>";
          echo "<td>".$row['MpesaReceiptNumber']."</td>";
          echo "<td>".$row['PhoneNumber']."</td>";
          echo "</tr>";
        }
     }
     ?>
    </tbody>
  </table>
</div>

<?php include 'footer.php'; ?>