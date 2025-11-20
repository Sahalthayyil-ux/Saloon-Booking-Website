<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Package Bookings</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 20px;
    color: #333;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    padding: 20px;
  }
  
  h2 {
    color: #1a5276;
    text-align: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #3498db;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
  }
  
  th {
    background-color: #1a5276;
    color: white;
    padding: 12px 15px;
    text-align: left;
    font-weight: bold;
  }
  
  td {
    padding: 10px 15px;
    border-bottom: 1px solid #ddd;
  }
  
  tr:nth-child(even) {
    background-color: #f2f2f2;
  }
  
  tr:hover {
    background-color: #e9f7fe;
  }
  
  a {
    color: #2980b9;
    text-decoration: none;
    font-weight: bold;
  }
  
  a:hover {
    color: #1a5276;
    text-decoration: underline;
  }
  
  .status-pending {
    color: #e74c3c;
    font-weight: bold;
  }
  
  .status-completed {
    color: #27ae60;
    font-weight: bold;
  }
  
  .status-advance {
    color: #f39c12;
    font-weight: bold;
  }
  
  .action-btn {
    display: inline-block;
    padding: 6px 12px;
    background-color: #3498db;
    color: white;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s;
  }
  
  .action-btn:hover {
    background-color: #2980b9;
    text-decoration: none;
    color: white;
  }
</style>
</head>

<body>
<div class="container">
  <h2>My Package Bookings</h2>
  <form id="form1" name="form1" method="post" action="">
    <table>
      <tr>
        <th>SI No</th>
        <th>Package Name</th>
        <th>Saloon Name</th>
        <th>From Date</th>
        <th>To Date</th>
        <th>Slot</th>
        <th>Advance Amount</th>
        <th>Status</th>
      </tr>
      <?php
      $i = 0;
      $sel="select * from tbl_packagebooking m INNER JOIN tbl_package p on m.package_id=p.package_id inner join tbl_saloon s on p.saloon_id=s.saloon_id inner join tbl_slot d on m.slot_id=d.slot_id where user_id='".$_SESSION['uid']."'";
      $row = $con->query($sel);
      if($row->num_rows > 0) {
        while($data = $row->fetch_assoc())
        {
          $i++;
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $data["package_name"]; ?></td>
          <td><?php echo $data["saloon_name"];?></td>
          <td><?php echo $data["packagebooking_date"]; ?></td>
          <td><?php echo $data["packagebooking_todate"]; ?></td>
          <td><?php echo $data['slot_from'] ?> - <?php echo $data['slot_to'] ?></td>
          <td>₹<?php echo $data["packagebooking_amount"]; ?></td>
          <td>
            <?php 
            if($data['packagebooking_status'] == 1) {
              echo '<span class="status-advance">Advance Payment Completed</span>';
              echo ' <a class="action-btn" href="Packagebill.php?bid='.$data['packagebooking_id'].'">View Bill</a>';
            } else if($data['packagebooking_status'] == 2) {
              echo '<span class="status-completed">Payment Completed</span>';
              echo ' <a class="action-btn" href="Packagebill.php?bid='.$data['packagebooking_id'].'">View Bill</a>';
            } else {
              echo '<span class="status-pending">Pending Payment</span>';
              echo ' <a class="action-btn" href="PaymentPackage.php?packid='.$data['packagebooking_id'].'">Make Payment</a>';
            }
            ?>
          </td>
        </tr>
        <?php
        }
      } else {
        echo '<tr><td colspan="8" style="text-align: center;">No package bookings found.</td></tr>';
      }
      ?>
    </table>
  </form>
</div>
</body>
</html>
<?php
include('Footer.php');
?>