<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
// 1. Total Bookings per Month (Normal + Package + Live)
$bookingMonthly = $con->query("
    SELECT month, SUM(total) as total_bookings FROM (
        SELECT DATE_FORMAT(booking_date, '%Y-%m') AS month, COUNT(*) AS total
        FROM tbl_booking GROUP BY month
        UNION ALL
        SELECT DATE_FORMAT(packagebooking_date, '%Y-%m') AS month, COUNT(*) AS total
        FROM tbl_packagebooking GROUP BY month
        UNION ALL
        SELECT DATE_FORMAT(livebooking_date, '%Y-%m') AS month, COUNT(*) AS total
        FROM tbl_livebooking GROUP BY month
    ) as all_bookings
    GROUP BY month ORDER BY month
");

// 2. Service Category Demand
$serviceDemand = $con->query("
    SELECT c.category_name, COUNT(r.requirements_id) as demand
    FROM tbl_requirements r
    JOIN tbl_salooncategory sc ON r.salooncategory_id = sc.salooncategory_id
    JOIN tbl_subcategory sub ON sc.subcategory_id = sub.subcat_id
    JOIN tbl_category c ON sub.category_id = c.category_id
    GROUP BY c.category_name
");

// 3. Salon Distribution by District
$salonDistrict = $con->query("
    SELECT d.district_name, COUNT(s.saloon_id) as total_salons
    FROM tbl_saloon s
    JOIN tbl_place p ON s.place_id = p.place_id
    JOIN tbl_district d ON p.district_id = d.district_id
    GROUP BY d.district_name
");

// 4. Monthly Package Bookings
$monthlyPackageBookings = $con->query("
    SELECT DATE_FORMAT(packagebooking_date, '%Y-%m') AS month, COUNT(*) AS total
    FROM tbl_packagebooking
    GROUP BY month ORDER BY month
");

// 5. Salon Leave Report
$salonLeaves = $con->query("
    SELECT s.saloon_name, DATE_FORMAT(l.leave_date, '%Y-%m') AS month, COUNT(*) AS total
    FROM tbl_leave l
    JOIN tbl_saloon s ON l.saloon_id = s.saloon_id
    GROUP BY s.saloon_name, month
    ORDER BY month
");

function fetchData($result) {
    $labels = [];
    $values = [];
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row[array_keys($row)[0]];
        $values[] = $row[array_keys($row)[1]];
    }
    return ['labels' => $labels, 'values' => $values];
}

// Convert results
$bookingMonthlyData = fetchData($bookingMonthly);
$serviceDemandData = fetchData($serviceDemand);
$salonDistrictData = fetchData($salonDistrict);
$monthlyPackageBookingsData = fetchData($monthlyPackageBookings);

$salonLeavesData = [];
while ($row = $salonLeaves->fetch_assoc()) {
    $salonLeavesData['labels'][] = $row['saloon_name']." (".$row['month'].")";
    $salonLeavesData['values'][] = $row['total'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Reports Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
    h1 { text-align: center; margin-bottom: 30px; color: #444; }
    .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(500px, 1fr)); gap: 20px; }
    .chart-container { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    h2 { text-align: center; color: #333; margin-bottom: 10px; font-size: 18px; }
    canvas { max-height: 350px; }
  </style>
</head>
<body>
    <tr>
     <td align="center" colspan="2"><a href="Adminhome.php"  style="float: right;">Home</a></td>
    </tr>
  <h1>📊 Admin Reports Dashboard</h1>
  
  <div class="grid">
    <div class="chart-container">
      <h2>Total Bookings per Month</h2>
      <canvas id="bookingMonthly"></canvas>
    </div>
    <div class="chart-container">
      <h2>Service Category Demand</h2>
      <canvas id="serviceDemand"></canvas>
    </div>
    <div class="chart-container">
      <h2>Salon Distribution by District</h2>
      <canvas id="salonDistrict"></canvas>
    </div>
    <div class="chart-container">
      <h2>Monthly Package Bookings</h2>
      <canvas id="monthlyPackageBookings"></canvas>
    </div>
    <div class="chart-container">
      <h2>Salon Leave Report</h2>
      <canvas id="salonLeaves"></canvas>
    </div>
  </div>

<script>
function renderChart(id, type, labels, data, labelName) {
    new Chart(document.getElementById(id), {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: labelName,
                data: data,
                backgroundColor: [
                  '#4CAF50','#2196F3','#FFC107','#FF5722','#9C27B0',
                  '#795548','#607D8B','#00BCD4','#E91E63','#8BC34A'
                ],
                borderWidth: 1
            }]
        },
        options: { responsive: true, plugins: { legend: { display: true } } }
    });
}

// Render Charts
renderChart("bookingMonthly","bar", <?php echo json_encode($bookingMonthlyData['labels']); ?>, <?php echo json_encode($bookingMonthlyData['values']); ?>, "Total Bookings");
renderChart("serviceDemand","bar", <?php echo json_encode($serviceDemandData['labels']); ?>, <?php echo json_encode($serviceDemandData['values']); ?>, "Demand");
renderChart("salonDistrict","doughnut", <?php echo json_encode($salonDistrictData['labels']); ?>, <?php echo json_encode($salonDistrictData['values']); ?>, "Salons");
renderChart("monthlyPackageBookings","line", <?php echo json_encode($monthlyPackageBookingsData['labels']); ?>, <?php echo json_encode($monthlyPackageBookingsData['values']); ?>, "Package Bookings");
renderChart("salonLeaves","bar", <?php echo json_encode($salonLeavesData['labels']); ?>, <?php echo json_encode($salonLeavesData['values']); ?>, "Leaves");
</script>
</body>
</html>
