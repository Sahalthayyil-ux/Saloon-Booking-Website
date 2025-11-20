<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Feedback</title>
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
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
    }
    
    .card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .page-title {
        text-align: center;
        margin-bottom: 30px;
        color: #1a73e8;
        font-size: 2rem;
        position: relative;
        padding-bottom: 15px;
    }
    
    .page-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: #1a73e8;
        border-radius: 2px;
    }
    
    .form-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    
    .form-table td {
        padding: 15px;
    }
    
    .form-label {
        color: #1a1a1a;
        font-weight: bold;
        width: 25%;
        vertical-align: top;
        padding-top: 20px;
    }
    
    textarea {
        width: 100%;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
        min-height: 150px;
        resize: vertical;
        transition: all 0.3s;
    }
    
    textarea:focus {
        outline: none;
        border-color: #1a73e8;
        box-shadow: 0 0 5px rgba(26, 115, 232, 0.3);
    }
    
    input[type="submit"] {
        background-color: #1a73e8;
        color: white;
        border: none;
        padding: 12px 30px;
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
    
    .feedback-info {
        text-align: center;
        color: #666;
        margin-bottom: 20px;
        font-style: italic;
    }
</style>
</head>
<body>
<?php

$fid="";

if(isset($_POST["btn_submit"]))
{
	$feedback = $_POST["txt_feedback"];
	$fid = $_POST["txt_id"];
	
	if($fid == "")
	{
		$ins = "insert into tbl_feedback(feedback_content,user_id) values('".$feedback."','".$_SESSION['uid']."')";
		
		if($con->query($ins))
		{
			echo '<div class="notification success">Thank you for your feedback!</div>';
			echo '<script>setTimeout(function(){ window.location="feedback.php"; }, 1500);</script>';
		}
		else
		{
			echo '<div class="notification error">Error submitting feedback. Please try again.</div>';
		}
	}
}
?>

<div class="container">
    <div class="card">
        <h1 class="page-title">Share Your Feedback</h1>
        <p class="feedback-info">We value your opinion. Please share your thoughts with us.</p>
        
        <form id="form1" name="form1" method="post" action="">
            <table class="form-table">
                <tr>
                    <td class="form-label">FEEDBACK</td>
                    <td>
                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $fid ?>" />
                        <textarea name="txt_feedback" id="txt_feedback" placeholder="Please share your feedback here..." required></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="submit-cell">
                        <input type="submit" name="btn_submit" id="btn_submit" value="Submit Feedback" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>
<?php
include('Footer.php');
?>