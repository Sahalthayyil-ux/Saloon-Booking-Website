<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

if (isset($_GET['sid'])) {
    $upQry = "update tbl_saloon set saloon_status=1 where saloon_id='" . $_GET['sid'] . "'";
    if ($con->query($upQry)) {
        ?>
        <script>
            alert("Saloon accepted..");
            window.location = "saloonlist.php";
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Saloon List</title>
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
        max-height: 600px; /* limit height to enable vertical scroll */
        overflow-x: auto;
        overflow-y: auto;
        border: 2px solid #000;
    }
    table {
        width: 150%; /* make table wider to show horizontal scroll */
        border-collapse: collapse;
        background: #fff;
        min-width: 1200px; /* ensures wide scrolling on smaller screens */
    }
    th, td {
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
        white-space: nowrap; /* prevents text wrapping, keeps horizontal scroll */
    }
    th {
        background: #000;
        color: #fff;
        position: sticky;
        top: 0; /* keeps headers visible when scrolling vertically */
        z-index: 2;
    }
    tr:nth-child(even) {
        background: #f2f2f2ff;
    }
    tr:hover {
        background: #e6e7ffff;
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
        margin: 2px;
    }
    .a:hover {
        background: #1616eb;
        color: #fff;
    }
    .status-accepted {
        color: green;
        font-weight: bold;
    }
    .status-rejected {
        color: red;
        font-weight: bold;
    }
</style>
</head>

<body>
    <h1>Saloon List</h1>
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
            $sel = "select * from tbl_saloon u 
                    INNER JOIN tbl_place p on u.place_id=p.place_id 
                    inner join tbl_district d on p.district_id=d.district_id 
                    inner join tbl_state s on d.state_id=s.state_id ORDER BY state_name ASC";
            $row = $con->query($sel);
            while ($data = $row->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data["saloon_name"]; ?></td>
                    <td><?php echo $data["saloon_email"]; ?></td>
                    <td><?php echo $data["saloon_contact"]; ?></td>
                    <td><?php echo $data["saloon_ownername"]; ?></td>
                    <td><?php echo $data["saloon_gstno"]; ?></td>
                    <td><?php echo $data["saloon_address"]; ?></td>
                    <td><img src="../Assets/Files/User/logo/<?php echo $data["saloon_logo"]; ?>" width="100" height="100" /></td>
                    <td><img src="../Assets/Files/User/proof/<?php echo $data["saloon_proof"]; ?>" width="100" height="100" /></td>
                    <td><?php echo $data["state_name"]; ?></td>
                    <td><?php echo $data["district_name"]; ?></td>
                    <td><?php echo $data["place_name"]; ?></td>
                    <td>
                        <?php
                        if ($data['saloon_status'] == 1) {
                            ?>
                            <span class="status-accepted">Accepted</span> 
                            <a href="saloonreason.php?rid=<?php echo $data['saloon_id'] ?>" class='a'>Reject</a>
                            <a href="LeaveList.php?sid=<?php echo $data['saloon_id'] ?>" class='a'>View Leave</a>
                            <?php
                        } else if ($data['saloon_status'] == 2) {
                            ?>
                            <span class="status-rejected">Rejected</span> 
                            <a href="saloonlist.php?sid=<?php echo $data['saloon_id'] ?>" class='a'>Accept</a>
                            <?php
                        } else {
                            ?>
                            <a href="saloonlist.php?sid=<?php echo $data['saloon_id'] ?>" class='a'>Accept</a>
                            <a href="saloonreason.php?rid=<?php echo $data['saloon_id'] ?>" class='a'>Reject</a>
                            <?php
                        }
                        ?>
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
