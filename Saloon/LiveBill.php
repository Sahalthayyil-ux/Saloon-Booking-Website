<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
$sel = "select * from tbl_livebooking lb inner join tbl_liverequirements l on l.livebooking_id=lb.livebooking_id inner join tbl_salooncategory sc on l.salooncategory_id=sc.salooncategory_id inner join  tbl_saloon s on sc.saloon_id=s.saloon_id  where l.livebooking_id=".$_GET['liveid'];
$row = $con->query($sel);
$data = $row->fetch_assoc();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salon Bill</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
  
  body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
    color: #333;
  }
  .invoice-container {
    max-width: 700px;
    margin: 30px auto;
    background: #ffffff;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border-radius: 12px;
    overflow: hidden;
  }
  .invoice-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    text-align: center;
    position: relative;
  }
  .invoice-header::after {
    content: "";
    position: absolute;
    bottom: -20px;
    left: 0;
    right: 0;
    height: 20px;
    background: #fff;
    border-radius: 0 0 12px 12px;
  }
  .salon-name {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 5px;
    letter-spacing: 1px;
  }
  .title{
    font-size: 35px;
    opacity: 2.0;
    font-weight: 600;
  }
  .invoice-title {
    font-size: 18px;
    opacity: 0.9;
    font-weight: 400;
  }
  .invoice-body {
    padding: 30px;
  }
  .client-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
    background: #f9f9ff;
    padding: 20px;
    border-radius: 8px;
  }
  .info-block {
    flex: 1;
  }
  .info-label {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
    font-weight: 500;
  }
  .info-value {
    font-size: 16px;
    font-weight: 600;
  }
  .status-badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }
  .services-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 30px 0;
  }
  .services-table thead th {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
    color: #4a5568;
    padding: 15px;
    text-align: left;
    font-weight: 600;
    border: none;
  }
  .services-table tbody td {
    padding: 15px;
    border-bottom: 1px solid #edf2f7;
    vertical-align: middle;
  }
  .services-table tbody tr:last-child td {
    border-bottom: none;
  }
  .services-table tbody tr:hover {
    background-color: #f8fafc;
  }
  .total-section {
    background: #f9f9ff;
    padding: 20px;
    border-radius: 8px;
    text-align: right;
    margin-top: 20px;
  }
  .total-label {
    font-size: 16px;
    color: #666;
    margin-right: 10px;
  }
  .total-amount {
    font-size: 24px;
    font-weight: 700;
    color: #4c51bf;
  }
  .invoice-footer {
    text-align: center;
    padding: 20px;
    border-top: 1px solid #eee;
    color: #666;
    font-size: 14px;
  }
  .thank-you {
    font-size: 18px;
    color: #4c51bf;
    margin-bottom: 10px;
    font-weight: 600;
  }
  .contact-info {
    margin-top: 15px;
    font-size: 14px;
  }
  .decoration {
    position: absolute;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
  }
  .dec-1 {
    top: -50px;
    right: -50px;
  }
  .dec-2 {
    bottom: -30px;
    left: -30px;
    width: 100px;
    height: 100px;
  }
  .payment-button {
    display: block;
    width: 200px;
    margin: 25px auto;
    padding: 12px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-align: center;
    text-decoration: none;
    font-weight: 600;
    border-radius: 30px;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 14px;
    border: none;
    cursor: pointer;
  }
  .payment-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    background: linear-gradient(135deg, #5a72e0 0%, #6b3fa0 100%);
  }
  .payment-button:active {
    transform: translateY(0);
  }
  @media print {
    .payment-button {
      display: none;
    }
  }
</style>
</head>

<body>
  <div class="invoice-container">
    <div class="invoice-header">
      <div class="decoration dec-1"></div>
      <div class="decoration dec-2"></div>
      <div class="title">Live Bill</div>
      <div class="invoice-title">Booking Invoice</div>
    </div>
    
    <div class="invoice-body">
      <div class="client-info">
        <div class="info-block">
          <div class="info-label">Client Name</div>
          <div class="info-value"><?php echo $data['livebooking_username']; ?></div>
        </div>
        <div class="info-block">
          <div class="info-label">Booking Date</div>
          <div class="info-value"><?php echo $data["livebooking_date"]; ?></div>
        </div>
      </div>
      
      <table class="services-table">
        <thead>
          <tr>
            <th>Service Category</th>
            <th>Service</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $scl = "SELECT * 
                  FROM tbl_liverequirements l 
                  INNER JOIN tbl_salooncategory sc ON l.salooncategory_id=sc.salooncategory_id 
                  INNER JOIN tbl_saloon s ON sc.saloon_id=s.saloon_id 
                  INNER JOIN tbl_livebooking lb ON l.livebooking_id=lb.livebooking_id 
                  INNER JOIN tbl_subcategory su ON sc.subcategory_id=su.subcat_id 
                  INNER JOIN tbl_category c ON c.category_id=su.category_id 
                  WHERE l.livebooking_id=".$_GET['liveid'];

          $roww = $con->query($scl);
          while($rdata = $roww->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $rdata["category_name"];?></td>
            <td><?php echo $rdata["subcat_name"];?></td>
            <td class="amount">₹<?php echo number_format($rdata["salooncategory_amount"], 2);?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      
      <div class="total-section">
        <span class="total-label">Total:</span>
        <span class="total-amount" id="subtotal-amt">₹<?php echo $data['livebooking_amount'];?></span>
      </div>
    </div>
    
    <div class="invoice-footer">
      <div class="thank-you">Thank You For Your Visit!</div>
      <div>We appreciate your business and look forward to serving you again</div>
      <div class="contact-info">
        <?php echo $data["saloon_name"]; ?> | <?php echo $data["saloon_email"]; ?> | <?php echo $data["saloon_contact"]; ?>
      </div>
    </div>

    <!-- Print Button -->
    <div style="text-align:center; margin:20px;">
      <button class="payment-button" onclick="window.print()">Print Bill</button>
    </div>

  </div>
</body>
</html>
