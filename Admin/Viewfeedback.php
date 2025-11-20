<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Feedback</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #000; /* Black background */
        color: #fff; /* White text */
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        color: #1616eb; /* Red heading */
        margin: 20px 0;
    }

    .feedback-container {
        width: 80%;
        margin: 30px auto;
        /* background: #111; Slightly lighter black */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 15px rgba(13, 0, 255, 0.5);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    table, th, td {
        border: 1px solid #1616eb; /* Red border */
    }

    th {
        background-color: #1616eb; /* Red header */
        color: #fff;
        padding: 12px;
        text-transform: uppercase;
    }

    td {
        padding: 10px;
        text-align: center;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #222; /* Dark gray for alternate rows */
    }

    tr:nth-child(odd) {
        background-color: #111; /* Darker black */
    }

    tr:hover {
        background-color: #1616eb; /* Highlight row in red */
        color: #fff;
        transition: 0.3s;
    }
</style>
</head>

<body>
    <h1>📌 User Feedback</h1>
    <div class="feedback-container">
        <form id="form1" name="form1" method="post" action="">
            <table>
                <tr>
                    <th>SI NO</th>
                    <th>Feedback</th>
                    <th>User</th>
                </tr>
                <?php
                $i = 0;
                $sel = "SELECT * FROM tbl_feedback f INNER JOIN tbl_user u ON f.user_id=u.user_id";
                $row = $con->query($sel);
                while ($data = $row->fetch_assoc()) {
                    $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $data['feedback_content']; ?></td>
                    <td><?php echo $data['user_name']; ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </form>
    </div>
</body>
</html>
<?php
include('Footer.php');
?>
