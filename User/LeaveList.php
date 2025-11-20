<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Saloon Leave Management</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f0f8ff;
        color: #333;
        padding: 20px;
        line-height: 1.6;
    }
    
    .container {
        max-width: 1000px;
        margin: 0 auto;
        background: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
    
    .header {
        background: #0066cc;
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    .header h1 {
        margin-bottom: 5px;
        font-size: 28px;
    }
    
    .header p {
        opacity: 0.9;
    }
    
    .content {
        padding: 30px;
    }
    
    .back-button {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 15px;
        background: #0066cc;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
    }
    
    .back-button:hover {
        background: #0055aa;
    }
    
    .back-button i {
        margin-right: 5px;
    }
    
    .leave-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    
    .leave-table th {
        background-color: #0066cc;
        color: white;
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }
    
    .leave-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
    }
    
    .leave-table tr:nth-child(even) {
        background-color: #f8fbff;
    }
    
    .leave-table tr:hover {
        background-color: #e6f2ff;
    }
    
    .no-leave {
        text-align: center;
        padding: 30px;
        color: #666;
        font-style: italic;
    }
    
    .no-leave i {
        font-size: 50px;
        display: block;
        margin-bottom: 15px;
        color: #ccc;
    }
    
    .summary {
        background: #e6f2ff;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .summary .total {
        font-weight: bold;
        color: #0066cc;
    }
    
    .footer {
        text-align: center;
        padding: 20px;
        background: #0066cc;
        color: white;
        font-size: 14px;
    }
    
    @media (max-width: 768px) {
        .leave-table {
            display: block;
            overflow-x: auto;
        }
        
        .summary {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1><i class="fas fa-calendar-alt"></i> Saloon Leave Management</h1>
        <p>View scheduled leave days for your saloon</p>
    </div>
    
    <div class="content">
        <a href="javascript:history.back()" class="back-button"><i class="fas fa-arrow-left"></i> Back to Previous Page</a>
        
        <div class="summary">
            <div>Saloon ID: <strong><?php echo isset($_GET['sid']) ? $_GET['sid'] : 'N/A'; ?></strong></div>
            <div class="total">Total Leave Days: 
                <strong>
                    <?php
                    include("../Assets/Connection/Connection.php");
                    include('SessionValidation.php');
                    if(isset($_GET['sid'])) {
                        $countQuery = "SELECT COUNT(*) as total FROM tbl_leave WHERE saloon_id='".$_GET['sid']."'";
                        $countResult = $con->query($countQuery);
                        if($countResult) {
                            $countData = $countResult->fetch_assoc();
                            echo $countData['total'];
                        } else {
                            echo "0";
                        }
                    } else {
                        echo "0";
                    }
                    ?>
                </strong>
            </div>
        </div>
        
        <table class="leave-table">
            <tr>
                <th>SI No</th>
                <th>Leave Date</th>
                <th>Day</th>
            </tr>
            <?php
            $i = 0;
            if(isset($_GET['sid'])) {
                $sel = "SELECT * FROM tbl_leave WHERE saloon_id='".$_GET['sid']."' ORDER BY leave_date DESC";
                $row = $con->query($sel);
                
                if($row && $row->num_rows > 0) {
                    while($data = $row->fetch_assoc()) {
                        $i++;
                        $leaveDate = $data["leave_date"];
                        $dayOfWeek = date('l', strtotime($leaveDate));
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $leaveDate; ?></td>
                <td><?php echo $dayOfWeek; ?></td>
            </tr>
            <?php
                    }
                } else {
            ?>
            <tr>
                <td colspan="3">
                    <div class="no-leave">
                        <i class="fas fa-calendar-times"></i>
                        <p>No leave days scheduled for this saloon</p>
                    </div>
                </td>
            </tr>
            <?php
                }
            } else {
            ?>
            <tr>
                <td colspan="3">
                    <div class="no-leave">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p>No saloon selected. Please go back and select a saloon.</p>
                    </div>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    
    <div class="footer">
        <p>Saloon Management System &copy; 2023 | Leave Management Module</p>
    </div>
</div>
</body>
</html>