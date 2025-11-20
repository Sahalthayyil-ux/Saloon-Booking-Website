<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Booking Report</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #fff;
        color: #000;
        margin: 0;
        padding: 0;
    }

    .container {
        padding: 30px;
    }

    h2 {
        text-align: center;
        color: #1616eb;
        margin-bottom: 10px;
    }

    h4 {
        text-align: center;
        color: #000;
        margin-bottom: 20px;
    }

    form {
        text-align: center;
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    table th, table td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }

    table th {
        background: #000;
        color: #fff;
        text-transform: uppercase;
    }

    table tr:nth-child(even) {
        background: #f9f9f9ff;
    }

    table tr:hover {
        background: #e6e5ffff;
    }

    .btn {
        padding: 10px 20px;
        background: #1616eb;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn:hover {
        background: #000;
        color: #fff;
    }

    input[type="date"] {
        padding: 6px;
        border: 1px solid #000;
        border-radius: 4px;
    }
</style>
</head>

<body>
<div class="container">
    <!-- Date Filter Form -->
    <form id="form1" name="form1" method="post" action="">
      <table style="margin: 0 auto; border-collapse:collapse; border:none;">
        <tr>
          <td><strong>From Date</strong></td>
          <td><input type="date" name="txt_from" id="txt_from" required></td>
          <td><strong>To Date</strong></td>
          <td><input type="date" name="txt_to" id="txt_to" required></td>
          <td><input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn"></td>
        </tr>
      </table>
    </form>

<?php
if(isset($_POST["btn_submit"])) {
    $from = new DateTime($_POST["txt_from"]);
    $fromdate = $from->format('d-m-Y');
    $to = new DateTime($_POST['txt_to']);
    $todate = $to->format('d-m-Y');

    $sel = "
        SELECT b.*, sl.saloon_name 
        FROM tbl_booking b
        INNER JOIN tbl_requirements r ON b.booking_id=r.booking_id
        INNER JOIN tbl_salooncategory c ON c.salooncategory_id=r.salooncategory_id
        INNER JOIN tbl_saloon sl ON sl.saloon_id=c.saloon_id
        WHERE b.booking_todate >= '".$_POST['txt_from']."' 
          AND b.booking_todate <= '".$_POST['txt_to']."' 
          AND b.booking_status='3'
    ";
    $row = $con->query($sel);

    if($row->num_rows > 0) {
        $i = 0;
        $grandTotal = 0;
        ?>
        <div id="report-section">
        <h2>Booking Report</h2>
        <h4>From <?php echo $fromdate; ?> To <?php echo $todate; ?></h4>
        <table>
          <tr>
            <th>S.No</th>
            <th>Salon</th>
            <th>Booking Date</th>
            <th>Booking To Date</th>
            <th>Amount</th>
          </tr>
          <?php
          while($data = $row->fetch_assoc()) {
              $i++;
              $grandTotal += $data["booking_total_amount"];
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data["saloon_name"]; ?></td>
                <td><?php echo $data["booking_date"]; ?></td>
                <td><?php echo $data["booking_todate"]; ?></td>
                <td>₹<?php echo number_format($data["booking_total_amount"],2); ?></td>
              </tr>
              <?php
          }
          ?>
          <tr style="font-weight:bold; background:#f0f0f0;">
            <td colspan="4" align="right">Grand Total</td>
            <td>₹<?php echo number_format($grandTotal,2); ?></td>
          </tr>
        </table>
        </div>

        <!-- Print Button -->
        <div style="text-align:center; margin-top:20px;">
          <button onclick="printReport()" class="btn">Print Report</button>
        </div>

        <script>
        function printReport() {
            var printContents = document.getElementById("report-section").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        </script>
        <?php
    } else {
        echo "<p style='color:red; text-align:center;'>No bookings found for this period.</p>";
    }
}
?>
</div>
</body>
</html>
<script src="../Assets/JQ/jQuery.js"></script> 
<script>
  $('#txt_from').change(function (){
    var from = $(this).val();
    $('#txt_to').attr('min',from)
  })
</script>
<script>
  const dateInput = document.getElementById('txt_from');
  const dateInput1 = document.getElementById('txt_to');
  const today = new Date();
  
  // Subtract 1 day to get yesterday
  const yesterday = new Date(today);
  yesterday.setDate(today.getDate() - 1);
  
  // Format as YYYY-MM-DD
  const yyyy = yesterday.getFullYear();
  const mm = String(yesterday.getMonth() + 1).padStart(2, '0');
  const dd = String(yesterday.getDate()).padStart(2, '0');
  const maxDate = ${yyyy}-${mm}-${dd};
  
  // Set the max attribute
  dateInput.max = maxDate;
  dateInput1.max = maxDate;
</script>
<?php
include('Footer.php');
?>