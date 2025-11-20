<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Package Booking Report</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;
        color: #000;
        margin: 0;
        /* padding: 20px; */
    }

    h2, h4 {
        color: #1616eb; /* Red */
        margin: 5px 0;
    }

    form {
        margin-bottom: 20px;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: auto;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        background-color: #e7e5ffff;
    }

    table th, table td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
    }

    table th {
        background-color: #000;
        color: #fff;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9ff;
    }

    table tr:hover {
        background-color: #e8e5ffff;
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

    #report-section {
        margin-top: 20px;
        padding: 20px;
        border: 2px solid #000;
        border-radius: 8px;
        background: #fff;
    }

    img {
        border: 2px solid #000;
        border-radius: 8px;
    }
</style>
</head>
<body>

<form id="form1" name="form1" method="post" action="">
  <table style="width:70%; border:2px solid #000; margin:auto;">
    <tr>
      <td><strong>From Date</strong></td>
      <td><input type="date" name="txt_from" id="txt_from" required /></td>
      <td><strong>To Date</strong></td>
      <td><input type="date" name="txt_to" id="txt_to" required /></td>
      <td><input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn"/></td>
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
        SELECT * 
        FROM tbl_packagebooking pb 
        INNER JOIN tbl_package p ON pb.package_id=p.package_id 
        WHERE pb.packagebooking_todate >= '".$_POST["txt_from"]."' 
          AND pb.packagebooking_todate <= '".$_POST['txt_to']."' 
          AND pb.packagebooking_status='2' 
          AND saloon_id='".$_GET['sid']."'
    ";
    $row = $con->query($sel);

    if($row->num_rows > 0) {
        $i = 0;
        $grandTotal = 0;
        ?>
        <div id="report-section">
        <h2 style="text-align:center;">Package Booking Report</h2>
        <h4 style="text-align:center;">From <?php echo $fromdate; ?> To <?php echo $todate; ?></h4>
        <table>
          <tr>
            <th>S.No</th>
            <th>Package Name</th>
            <th>Amount</th>
            <th>Image</th>
            <th>Details</th>
          </tr>
          <?php
          while($data = $row->fetch_assoc()) {
              $i++;
              $grandTotal += $data["package_amount"];
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data["package_name"]; ?></td>
                <td>₹<?php echo number_format($data["package_amount"],2); ?></td>
                <td><img src="../Assets/Files/saloon/package/<?php echo $data["package_photo"];?>" width="100" height="100"/></td>
                <td><?php echo $data["package_description"]; ?></td>
              </tr>
              <?php
          }
          ?>
          <tr style="font-weight:bold; background:#1616eb; color:#fff;">
            <td colspan="2" align="right">Grand Total</td>
            <td colspan="3">₹<?php echo number_format($grandTotal,2); ?></td>
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
        echo "<p style='color:#1616eb; text-align:center; font-weight:bold;'>No package bookings found for this period.</p>";
    }
}
?>

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