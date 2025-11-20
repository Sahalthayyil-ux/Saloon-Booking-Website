<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Package Booking Bill</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
  body {font-family: 'Poppins', sans-serif;background-color: #f8f9fa;margin:0;padding:0;color:#333;}
  .invoice-container {max-width:700px;margin:30px auto;background:#fff;box-shadow:0 10px 30px rgba(0,0,0,0.08);border-radius:12px;overflow:hidden;}
  .invoice-header {background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:#fff;padding:30px;text-align:center;position:relative;}
  .invoice-header::after {content:"";position:absolute;bottom:-20px;left:0;right:0;height:20px;background:#fff;border-radius:0 0 12px 12px;}
  .salon-name {font-size:32px;font-weight:700;margin-bottom:5px;letter-spacing:1px;}
  .invoice-title {font-size:18px;opacity:0.9;font-weight:400;}
  .invoice-body {padding:30px;}
  .client-info {display:flex;justify-content:space-between;margin-bottom:30px;background:#f9f9ff;padding:20px;border-radius:8px;}
  .info-block {flex:1;}
  .info-label {font-size:14px;color:#666;margin-bottom:5px;font-weight:500;}
  .info-value {font-size:16px;font-weight:600;}
  .status-badge {display:inline-block;padding:6px 12px;border-radius:20px;font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:.5px;}
  .status-paid {background:#d1fae5;color:#065f46;}
  .status-pending {background:#fef3c7;color:#92400e;}
  .services-table {width:100%;border-collapse:separate;border-spacing:0;margin:30px 0;}
  .services-table thead th {background:linear-gradient(135deg,#f5f7fa 0%,#e4e8f0 100%);color:#4a5568;padding:15px;text-align:left;font-weight:600;}
  .services-table tbody td {padding:15px;border-bottom:1px solid #edf2f7;vertical-align:middle;}
  .services-table tbody tr:last-child td {border-bottom:none;}
  .services-table tbody tr:hover {background:#f8fafc;}
  .total-section {background:#f9f9ff;padding:20px;border-radius:8px;text-align:right;margin-top:20px;}
  .total-label {font-size:16px;color:#666;margin-right:10px;}
  .total-amount {font-size:24px;font-weight:700;color:#4c51bf;}
  .invoice-footer {text-align:center;padding:20px;border-top:1px solid #eee;color:#666;font-size:14px;}
  .thank-you {font-size:18px;color:#4c51bf;margin-bottom:10px;font-weight:600;}
  .contact-info {margin-top:15px;font-size:14px;}
  .payment-button {display:block;width:200px;margin:25px auto;padding:12px 20px;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:#fff;text-align:center;font-weight:600;border-radius:30px;box-shadow:0 4px 15px rgba(102,126,234,0.3);transition:all .3s ease;text-transform:uppercase;letter-spacing:1px;font-size:14px;border:none;cursor:pointer;}
  .payment-button:hover {transform:translateY(-2px);box-shadow:0 6px 20px rgba(102,126,234,0.4);background:linear-gradient(135deg,#5a72e0 0%,#6b3fa0 100%);}
</style>
</head>

<body onLoad="calculate()">
<?php
$sel="SELECT pb.*, u.user_name, p.package_name, p.package_amount, n.saloon_name, n.saloon_email, n.saloon_contact
      FROM tbl_packagebooking pb 
      INNER JOIN tbl_user u ON pb.user_id=u.user_id
      INNER JOIN tbl_package p ON pb.package_id=p.package_id
      INNER JOIN tbl_saloon n ON p.saloon_id=n.saloon_id
      WHERE pb.packagebooking_id='".$_GET['bid']."'";
$row = $con->query($sel);
$data = $row->fetch_assoc();
?>
  <div class="invoice-container">
    <div class="invoice-header">
      <div class="invoice-title">Package Bill</div>
      <div class="invoice-title">Package Booking Invoice</div>
    </div>
    
    <div class="invoice-body">
      <div class="client-info">
        <div class="info-block">
          <div class="info-label">Client Name</div>
          <div class="info-value"><?php echo $data['user_name']; ?></div>
        </div>
        <div class="info-block">
          <div class="info-label">Booking Date</div>
          <div class="info-value"><?php echo $data["packagebooking_date"]; ?></div>
        </div>
        <div class="info-block">
          <div class="info-label">Invoice Status</div>
          <div class="status-badge <?php echo ($data['packagebooking_status'] == 1) ? 'status-paid' : 'status-pending'; ?>">
          <?php
          if($data['packagebooking_status'] == 1){
              echo "Advance Paid";
          } else if($data['packagebooking_status'] == 2){
              echo "Payment Completed";
          } else {
              echo "Pending";
          }
          ?>
          </div>
        </div>
      </div>
      
      <table class="services-table">
        <thead>
          <tr>
            <th>Package</th>
            <th>Details</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $data["package_name"]; ?></td>
            <td>Complete Package</td>
            <td class="amount">₹<?php echo number_format($data["packagebooking_totalamount"], 2); ?></td>
          </tr>
        </tbody>
      </table>
      
      <div class="total-section" style="margin-top: 10px; background: #fff1f2;">
        <span class="total-label">Advance Paid:</span>
        <span class="total-amount" style="color: #db2777;" id="advance-amt">₹<?php echo number_format($data["packagebooking_amount"], 2); ?></span>
      </div>
      
      <div class="total-section">
        <span class="total-label">Total:</span>
        <span class="total-amount" id="subtotal-amt">₹</span>
      </div>
      
      <div class="total-section" style="margin-top: 10px; background: #ecfdf5;">
        <span class="total-label">Balance Due:</span>
        <span class="total-amount" style="color: #065f46;" id="balance-amt">₹</span>
      </div>
    </div>
    <?php if($data['packagebooking_status'] == 1){ ?>
     <div class="invoice-footer">
      <div class="thank-you">Payment not complete</div>
    </div>
    <?php } ?>
    
    <div class="invoice-footer">
      <div class="thank-you">Thank You For Your Visit!</div>
      <div>We appreciate your business and look forward to serving you again</div>
      <div class="contact-info">
        <?php echo $data["saloon_name"]; ?> | <?php echo $data["saloon_email"]; ?> | <?php echo $data["saloon_contact"]; ?>
      </div>
    </div>
  </div>
</body>
</html>
<script>
function calculate() {
    var amount = document.querySelectorAll('.amount');
    var balanceamount = document.getElementById('balance-amt');
    var subtotalamount = document.getElementById('subtotal-amt');
    var advanceamount = document.getElementById('advance-amt').textContent;
    var aamt = parseFloat(advanceamount.replace(/[^0-9.]/g, ""));
    var subtotal = 0;
    var totalamount = document.getElementById('total-amount');
    amount.forEach(function(amt) {
        var tamt = parseFloat(amt.textContent.replace(/[^0-9.]/g, ""));
        subtotal += tamt;
    });
    var balance = subtotal - aamt;
    var subtotalFormatted = subtotal.toLocaleString("en-IN", { minimumFractionDigits: 2 });
    var balanceFormatted  = balance.toLocaleString("en-IN", { minimumFractionDigits: 2 });
    subtotalamount.innerHTML = "₹" + subtotalFormatted;
    balanceamount.innerHTML  = "₹" + balanceFormatted;
    totalamount.value = balance;
}
</script>
