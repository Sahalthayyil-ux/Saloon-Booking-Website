<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
if(isset($_POST['btn_submit']))
{
	$reason = $_POST["txt_reason"];
	$upQry="update tbl_saloon set saloon_status=2,saloon_reason='".$reason."' where saloon_id='".$_GET['rid']."'";
	if($con->query($upQry))
	{
		?>
        <script>
        alert("saloon rejected..")
		window.location="saloonlist.php"
        </script>
        <?php	
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Salon Rejection</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
        background-color: #f5f5f5;
        color: #000;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }
    
    .container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
        overflow: hidden;
    }
    
    .header {
        background: #d32f2f;
        color: white;
        padding: 20px;
        text-align: center;
    }
    
    h1 {
        font-size: 24px;
        font-weight: 600;
        margin: 0;
    }
    
    .form-container {
        padding: 30px;
    }
    
    .form-title {
        color: #000;
        margin-bottom: 20px;
        text-align: center;
        font-size: 20px;
        font-weight: 600;
        position: relative;
        padding-bottom: 10px;
    }
    
    .form-title:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: #d32f2f;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #000;
    }
    
    textarea {
        width: 100%;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: all 0.3s;
        resize: vertical;
        min-height: 150px;
        background: #fff;
        color: #000;
    }
    
    textarea:focus {
        border-color: #d32f2f;
        box-shadow: 0 0 0 2px rgba(211, 47, 47, 0.2);
        outline: none;
    }
    
    .btn-container {
        text-align: center;
        margin-top: 10px;
    }
    
    .btn {
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        font-weight: 600;
    }
    
    .btn-submit {
        background: #d32f2f;
        color: white;
    }
    
    .btn-submit:hover {
        background: #b71c1c;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(183, 28, 28, 0.3);
    }
    
    .warning-text {
        text-align: center;
        color: #d32f2f;
        font-size: 14px;
        margin-top: 15px;
        font-weight: 500;
    }
    
    .info-box {
        background: #f9f9f9;
        border-left: 4px solid #d32f2f;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    
    .info-title {
        font-weight: 600;
        color: #000;
        margin-bottom: 5px;
    }
    
    .info-content {
        color: #333;
        font-size: 14px;
    }
    
    @media (max-width: 576px) {
        .container {
            margin: 10px;
        }
        
        .form-container {
            padding: 20px;
        }
        
        textarea {
            min-height: 120px;
        }
    }
</style>
</head>

<body>
<div class="container">
    <div class="header">
        <h1>Salon Registration Rejection</h1>
    </div>
    
    <div class="form-container">
        <h2 class="form-title">Provide Rejection Reason</h2>
        
       
        
        <form id="form1" name="form1" method="post" action="">
            <div class="form-group">
                <label for="txt_reason" class="form-label">Rejection Reason:</label>
                <textarea name="txt_reason" id="txt_reason" required="required" placeholder="Please specify the reason for rejecting this salon registration..."></textarea>
            </div>
            
            <div class="btn-container">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit Rejection" class="btn btn-submit" />
            </div>
        </form>
        
      
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form1');
        const textarea = document.getElementById('txt_reason');
        
        form.addEventListener('submit', function(e) {
            if (!textarea.value.trim()) {
                e.preventDefault();
                alert('Please provide a rejection reason before submitting.');
                textarea.focus();
                return false;
            }
            
            if (textarea.value.trim().length < 10) {
                e.preventDefault();
                alert('Please provide a more detailed rejection reason (at least 10 characters).');
                textarea.focus();
                return false;
            }
            
            if (!confirm('Are you sure you want to reject this salon registration? This action cannot be undone.')) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
</body>
</html>