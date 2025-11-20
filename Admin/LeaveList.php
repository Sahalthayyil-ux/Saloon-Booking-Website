<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Salon Leave Report</title>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  
  body {
    background-color: #f5f5f5;
    color: #000;
    padding: 20px;
    line-height: 1.6;
  }
  
  .container {
    max-width: 1000px;
    margin: 0 auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    padding: 30px;
  }
  
  .header {
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #1616eb;
  }
  
  h2 {
    color: #000;
    font-size: 28px;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  
  .subtitle {
    color: #666;
    font-size: 16px;
  }
  
  .report-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
    padding: 15px;
    background: #f9f9f9;
    border-radius: 5px;
    border-left: 4px solid #1616eb;
  }
  
  .info-item {
    display: flex;
    flex-direction: column;
  }
  
  .info-label {
    font-weight: bold;
    color: #000;
    margin-bottom: 5px;
  }
  
  .info-value {
    color: #1616eb;
    font-weight: 600;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: #fff;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
  }
  
  th, td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
  }
  
  th {
    background-color: #000;
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  
  tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  tr:hover {
    background-color: #f0eeffff;
  }
  
  .total-row {
    font-weight: bold;
    background-color: #eeeeffff;
    color: #000;
  }
  
  .total-row td {
    border-top: 2px solid #1616eb;
    font-size: 18px;
  }
  
  .print-btn {
    display: block;
    margin: 30px auto 10px;
    padding: 12px 30px;
    background: #1616eb;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: all 0.3s;
    text-transform: uppercase;
    letter-spacing: 1px;
  }
  
  .print-btn:hover {
    background: #b71c1c;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(183, 28, 28, 0.3);
  }
  
  .no-data {
    text-align: center;
    padding: 30px;
    color: #666;
    font-style: italic;
  }
  
  @media print {
    body * {
      visibility: hidden;
    }
    #report-section, #report-section * {
      visibility: visible;
    }
    #report-section {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
    }
    .print-btn {
      display: none;
    }
  }
  
  @media (max-width: 768px) {
    .container {
      padding: 15px;
    }
    
    .report-info {
      flex-direction: column;
    }
    
    .info-item {
      margin-bottom: 10px;
    }
    
    th, td {
      padding: 10px;
      font-size: 14px;
    }
  }
</style>
</head>

<body>
<div class="container">
  <div class="header">
    <h2>Salon Leave Report</h2>
    <p class="subtitle">Comprehensive record of all leave dates</p>
  </div>
  
  <?php
  // Get salon information
  $salonId = $_GET['sid'];
  $salonQuery = "SELECT * FROM tbl_saloon WHERE saloon_id = '$salonId'";
  $salonResult = $con->query($salonQuery);
  $salonData = $salonResult->fetch_assoc();
  ?>
  
  <div class="report-info">
    <div class="info-item">
      <span class="info-label">Salon Name:</span>
      <span class="info-value"><?php echo $salonData['saloon_name'] ?? 'N/A'; ?></span>
    </div>
    <div class="info-item">
      <span class="info-label">Report Date:</span>
      <span class="info-value"><?php echo date('F j, Y'); ?></span>
    </div>
    <div class="info-item">
      <span class="info-label">Report ID:</span>
      <span class="info-value">LR-<?php echo rand(1000, 9999); ?></span>
    </div>
  </div>
  
  <div id="report-section">
    <table>
      <thead>
        <tr>
          <th>SI No</th>
          <th>Leave Date</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 0;
        $totalLeaves = 0;
        $sel = "SELECT * FROM tbl_leave WHERE saloon_id='".$_GET['sid']."' ORDER BY leave_date DESC";
        $row = $con->query($sel);
        
        if($row && $row->num_rows > 0) {
          while($data = $row->fetch_assoc()) {
            $i++;
            $totalLeaves++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo date('F j, Y', strtotime($data["leave_date"])); ?></td>
            </tr>
            <?php
          }
        } else {
          ?>
          <tr>
            <td colspan="2" class="no-data">No leave records found for this salon.</td>
          </tr>
          <?php
        }
        ?>
        <tr class="total-row">
          <td colspan="2">Total Leaves: <?php echo $totalLeaves; ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <button class="print-btn" onclick="printReport()">
    <i class="fas fa-print"></i> Print Report
  </button>
</div>

<script>
function printReport() {
  window.print();
}
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>