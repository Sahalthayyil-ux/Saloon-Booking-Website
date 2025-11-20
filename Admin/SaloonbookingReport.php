<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Salon Booking Report</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
        color: #000;
    }

    .container {
        padding: 30px;
    }

    h2 {
        text-align: center;
        color: #1616eb;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin: 0 auto;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        overflow-x: auto;
    }

    table th, table td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }

    table th {
        background-color: #000;
        color: #fff;
        text-transform: uppercase;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9ff;
    }

    table tr:hover {
        background-color: #e5e5ffff;
    }

    img {
        border: 2px solid #000;
        border-radius: 5px;
    }

    .a {
        text-decoration: none;
        color: #fff;
        background-color: #1616eb;
        padding: 6px 12px;
        border-radius: 5px;
        transition: 0.3s ease;
        font-weight: bold;
    }

    a:hover {
        background-color: #000;
        color: #fff;
    }

    .table-wrapper {
        overflow-x: auto;
    }
</style>
</head>

<body>
<div class="container">
    <h2>Salon Booking Report</h2>
    <div class="table-wrapper">
    <table>
        <tr>
            <th>SINO</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>CONTACT</th>
            <th>OWNER NAME</th>
            <th>GST NO</th>
            <th>ADDRESS</th>
            <th>LOGO</th>
            <th>PROOF</th>
            <th>STATE</th>
            <th>DISTRICT</th>
            <th>PLACE</th>
            <th>ACTION</th>
        </tr>
         <?php
        $i = 0;
        $sel="select * from tbl_saloon u 
              INNER JOIN tbl_place p on u.place_id=p.place_id 
              inner join tbl_district d on p.district_id=d.district_id 
              inner join tbl_state s on d.state_id=s.state_id 
              where saloon_status='1'";
        $row = $con->query($sel);
        while($data = $row->fetch_assoc())
        {
            $i++;
          ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $data["saloon_name"];?></td>
          <td><?php echo $data["saloon_email"];?></td>
          <td><?php echo $data["saloon_contact"];?></td>
          <td><?php echo $data["saloon_ownername"];?></td>
          <td><?php echo $data["saloon_gstno"];?></td>
          <td><?php echo $data["saloon_address"];?></td>
          <td><img src="../Assets/Files/User/logo/<?php echo $data["saloon_logo"];?>" width="120" height="120"/></td>
          <td><img src="../Assets/Files/User/proof/<?php echo $data["saloon_proof"];?>" width="120" height="120" /></td>
          <td><?php echo $data["state_name"];?></td>
          <td><?php echo $data["district_name"];?></td>
          <td><?php echo $data["place_name"];?></td>
          <td>
            <a href="SaloonbookingReportdetails.php?sid=<?php echo $data['saloon_id'] ?>" class="a">View Report</a>
          </td>
        </tr>
        <?php
        }
        ?>
    </table>
    </div>
</div>
</body>
</html>
<?php
include('Footer.php');
?>
