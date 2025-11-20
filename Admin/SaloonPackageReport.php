<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Saloon Package Report</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;
        color: #000;
        margin: 0;
        /* padding: 20px; */
    }
    h1 {
        text-align: center;
        color: #1616eb;
        margin-bottom: 20px;
    }
    .table-container {
        width: 100%;
        max-height: 600px; /* Enables vertical scroll */
        overflow-x: auto;
        overflow-y: auto;
        border: 2px solid #000;
        background: #fff;
    }
    table {
        width: 150%; /* force horizontal scroll */
        border-collapse: collapse;
        min-width: 1200px;
    }
    th, td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
        white-space: nowrap; /* prevent wrapping */
    }
    th {
        background: #000;
        color: #fff;
        position: sticky;
        top: 0; /* keeps header visible */
        z-index: 2;
    }
    tr:nth-child(even) {
        background: #f2f2f2ff;
    }
    tr:hover {
        background: #ebe6ffff;
    }
    .a {
        color: #1616eb;
        font-weight: bold;
        text-decoration: none;
        padding: 5px 8px;
        border: 1px solid #1616eb;
        border-radius: 5px;
        transition: 0.3s;
        background: #fff;
        display: inline-block;
    }
    a:hover {
        background: #1616eb;
        color: #fff;
    }
</style>
</head>

<body>
    <h1>Saloon Package Report</h1>
    <form id="form1" name="form1" method="post" action="">
        <div class="table-container">
        <table>
            <tr>
                <th>SINO</th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th>CONTACT</th>
                <th>OWNERNAME</th>
                <th>GSTNO</th>
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
            while($data = $row->fetch_assoc()) {
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
                    <td><img src="../Assets/Files/User/logo/<?php echo $data["saloon_logo"];?>" width="100" height="100"/></td>
                    <td><img src="../Assets/Files/User/proof/<?php echo $data["saloon_proof"];?>" width="100" height="100" /></td>
                    <td><?php echo $data["state_name"];?></td>
                    <td><?php echo $data["district_name"];?></td>
                    <td><?php echo $data["place_name"];?></td>
                    <td>
                        <a href="SaloonPackageReportDetails.php?sid=<?php echo $data['saloon_id'] ?>"class='a'>View Report</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        </div>
    </form>
</body>
</html>
<?php
include('Footer.php');
?>
