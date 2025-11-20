<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Saloon List</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f8f9fa;
        color: #333;
        padding: 20px;
    }
    
    .container {
        max-width: 1400px;
        margin: 0 auto;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        padding: 30px;
        border: 1px solid #e0e0e0;
    }
    
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        color: #1a73e8;
        font-size: 28px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e6f0ff;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }
    
    th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #e0e0e0;
    }
    
    th {
        background-color: #1a73e8;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        letter-spacing: 0.5px;
    }
    
    tr:nth-child(even) {
        background-color: #f8fbff;
    }
    
    tr:hover {
        background-color: #e6f0ff;
        transition: background-color 0.3s ease;
    }
    
    .action-link {
        display: inline-block;
        padding: 8px 15px;
        background-color: #1a73e8;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .action-link:hover {
        background-color: #0d5bba;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .image-cell {
        text-align: center;
    }
    
    .image-cell img {
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .image-cell img:hover {
        transform: scale(1.05);
    }
    
    .no-data {
        text-align: center;
        padding: 30px;
        color: #666;
        font-style: italic;
    }
    
    @media (max-width: 1200px) {
        .container {
            padding: 15px;
        }
        
        table {
            font-size: 14px;
        }
        
        th, td {
            padding: 10px;
        }
    }
    
    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
        }
        
        th, td {
            white-space: nowrap;
        }
        
        .action-link {
            padding: 6px 10px;
            font-size: 12px;
        }
    }
</style>
</head>

<body>
<div class="container">
    <h2 class="page-title">Saloon List</h2>
    
    <div class="table-container">
        <table>
            <thead>
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
            </thead>
            <tbody>
                <?php
                $i = 0;
                $sel = "SELECT * FROM tbl_saloon u INNER JOIN tbl_place p ON u.place_id = p.place_id 
                        INNER JOIN tbl_district d ON p.district_id = d.district_id 
                        INNER JOIN tbl_state s ON d.state_id = s.state_id 
                        WHERE saloon_status = '1'";
                $row = $con->query($sel);
                
                if ($row && $row->num_rows > 0) {
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
                    <td class="image-cell">
                        <img src="../Assets/Files/User/logo/<?php echo $data["saloon_logo"];?>" width="80" height="80" alt="Saloon Logo"/>
                    </td>
                    <td class="image-cell">
                        <img src="../Assets/Files/User/proof/<?php echo $data["saloon_proof"];?>" width="80" height="80" alt="Proof Document"/>
                    </td>
                    <td><?php echo $data["state_name"];?></td>
                    <td><?php echo $data["district_name"];?></td>
                    <td><?php echo $data["place_name"];?></td>
                    <td>
                        <a href="LeaveList.php?sid=<?php echo $data['saloon_id'] ?>" class="action-link">View Leave List</a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                ?>
                <tr>
                    <td colspan="13" class="no-data">No saloons found with active status.</td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php
include('Footer.php');
?>