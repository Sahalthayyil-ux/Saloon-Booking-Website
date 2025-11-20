<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');

if(isset($_POST["btn_submit"]))
{
	$reply = $_POST["txt_reply"];
	$upQry = "update tbl_complaint set complaint_reply='".$reply."',complaint_status=1 where complaint_id = ".$_GET['cid'];
	if($con->query($upQry))
	{
		?>
		<script>
		alert("Reply sent...")
		window.location="Viewcomplaint.php"
		</script>
		<?php 
	}
}
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Reply to Complaint</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #ffffff;
        margin: 0;
        padding: 0;
        color: #000;
    }

    .container {
        width: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #fff 70%, #ff0000 30%);
        padding: 20px;
    }

    .reply-box {
        background: #fff;
        border: 2px solid #000;
        border-radius: 10px;
        padding: 30px;
        width: 450px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .reply-box h2 {
        text-align: center;
        color: #ff0000;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
    }

    td {
        padding: 10px;
        font-weight: bold;
        color: #000;
    }

    textarea {
        width: 100%;
        padding: 10px;
        border: 2px solid #000;
        border-radius: 6px;
        font-size: 14px;
        resize: none;
        background-color: #f9f9f9;
    }

    textarea:focus {
        outline: none;
        border-color: #ff0000;
        box-shadow: 0 0 6px rgba(255,0,0,0.6);
    }

    .btn-submit {
        display: inline-block;
        padding: 12px 25px;
        border: none;
        border-radius: 6px;
        background-color: #ff0000;
        color: #fff;
        font-size: 16px;
        font-weight: bold;
        text-transform: uppercase;
        cursor: pointer;
        margin-top: 15px;
        transition: 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #000;
        color: #fff;
    }

    .center {
        text-align: center;
    }
</style>
</head>

<body>
<div class="container">
    <div class="reply-box">
        <h2>Reply to Complaint</h2>
        <form id="form1" name="form1" method="post" action="">
          <table>
            <tr>
              <td>Reply</td>
              <td><textarea name="txt_reply" id="txt_reply" cols="45" rows="5" required></textarea></td>
            </tr>
            <tr>
              <td colspan="2" class="center">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" class="btn-submit" />
              </td>
            </tr>
          </table>
        </form>
    </div>
</div>
</body>
</html>
