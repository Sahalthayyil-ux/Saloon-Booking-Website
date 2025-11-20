<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint Management</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f5f7fa;
        color: #333;
        line-height: 1.6;
    }
    
    .container {
        max-width: 1000px;
        margin: 30px auto;
        padding: 20px;
    }
    
    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 25px;
        margin-bottom: 30px;
    }
    
    h2 {
        color: #1a73e8;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e6e6e6;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    
    .form-table td {
        padding: 12px 15px;
    }
    
    .form-label {
        color: #1a1a1a;
        font-weight: bold;
        width: 20%;
    }
    
    input[type="text"], textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }
    
    input[type="text"]:focus, textarea:focus {
        outline: none;
        border-color: #1a73e8;
        box-shadow: 0 0 5px rgba(26, 115, 232, 0.3);
    }
    
    textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    input[type="submit"] {
        background-color: #1a73e8;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        transition: background-color 0.3s;
    }
    
    input[type="submit"]:hover {
        background-color: #0d5bba;
    }
    
    .submit-cell {
        text-align: center;
        padding-top: 15px;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }
    
    .data-table th {
        background-color: #1a73e8;
        color: white;
        text-align: left;
        padding: 12px 15px;
    }
    
    .data-table td {
        padding: 10px 15px;
        border-bottom: 1px solid #e6e6e6;
    }
    
    .data-table tr:nth-child(even) {
        background-color: #f2f7ff;
    }
    
    .data-table tr:hover {
        background-color: #e6f0ff;
    }
    
    .action-link {
        color: #e53935;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 3px;
        transition: background-color 0.3s;
    }
    
    .action-link:hover {
        background-color: #ffebee;
    }
    
    .notification {
        padding: 12px;
        margin: 15px 0;
        border-radius: 4px;
        text-align: center;
    }
    
    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    .no-complaints {
        text-align: center;
        padding: 20px;
        color: #666;
        font-style: italic;
    }
</style>
</head>
<body>
<?php

if(isset($_POST["btn_submit"]))
{
    $title = $_POST["txt_title"];
    $content = $_POST["txt_content"];
    
    $ins = "insert into tbl_complaint(complaint_date,complaint_title,complaint_content,user_id) values(curdate(),'".$title."','".$content."','".$_SESSION['uid']."')";
    
    if($con->query($ins))
    {
        echo '<div class="notification success">Complaint registered successfully!</div>';
    }
}

if(isset($_GET["delid"]))
{
    $del = "delete from tbl_complaint where complaint_id='".$_GET["delid"]."'";
    
    if($con->query($del))
    {
        echo '<div class="notification success">Complaint deleted successfully!</div>';
    }
}
?>

<div class="container">
    <div class="card">
        <h2>Register a Complaint</h2>
        <form id="form1" name="form1" method="post" action="">
            <table class="form-table">
                <tr>
                    <td class="form-label">TITLE</td>
                    <td>
                        <input type="text" name="txt_title" id="txt_title" required/>
                    </td>
                </tr>
                <tr>
                    <td class="form-label">CONTENT</td>
                    <td>
                        <textarea name="txt_content" id="txt_content" required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="submit-cell">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <div class="card">
        <h2>Your Complaints</h2>
        <table class="data-table">
            <tr>
                <th>SI NO</th>
                <th>TITLE</th>
                <th>CONTENT</th>
                <th>DATE</th>
                <th>REPLY</th>
                <th>ACTION</th>
            </tr>
            <?php
            $i = 0;
            $sel = "select * from tbl_complaint where user_id='".$_SESSION['uid']."'";
            $row = $con->query($sel);
            
            if($row->num_rows > 0) {
                while($data = $row->fetch_assoc())
                {
                    $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $data["complaint_title"]; ?></td>
                <td><?php echo $data["complaint_content"]; ?></td>
                <td><?php echo $data["complaint_date"]; ?></td>
                <td><?php echo $data["complaint_reply"] ? $data["complaint_reply"] : "<span style='color:#666;'>No reply yet</span>"; ?></td>
                <td><a href="Complaint.php?delid=<?php echo $data['complaint_id'] ?>" class="action-link">Delete</a></td>
            </tr>
            <?php
                }
            } else {
            ?>
            <tr>
                <td colspan="6" class="no-complaints">You haven't registered any complaints yet.</td>
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