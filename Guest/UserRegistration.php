<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_submit"]))
{
    
    $name = $_POST["txt_name"];
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];
    $contact=$_POST["txt_contact"];
    $photo=$_FILES['file_photo']['name'];
    $path=$_FILES['file_photo']['tmp_name'];
    move_uploaded_file($path,'../Assets/Files/User/Photo/'.$photo);
    $place=$_POST["scl_place"];
    
    $sel = "select * from tbl_user where user_email='".$email."'";
    $row = $con->query($sel);
    $sel1 = "select * from tbl_saloon where saloon_email='".$email."'";
    $row1 = $con->query($sel1);
    if($row->num_rows > 0 || $row1->num_rows > 0)
    {
        ?>
        <script>
        alert("Email already exists..")
        window.location="UserRegistration.php"
        </script>
        <?php
    }
    else
    {
    
    $ins = "insert into tbl_user(user_name,user_email,user_contact,user_password,user_photo,place_id) values('".$name."','".$email."','".$contact."','".$password."','".$photo."','".$place."')";
    
    if($con->query($ins))
    {
        ?>
        <script>
        alert("Data inserted..")
        window.location="UserRegistration.php"
        </script>
        <?php    
      }
    } 
  }
 ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>USER REGISTRATION</title>
<style>
   body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-image: url("../Assets/Templates/Images/salon bg image.jpg");
    margin: 0;
    padding: 20px;
    color: #333;
    backdrop-filter: blur(5px);
}
    
    .container {
        max-width: 400px;
        margin: 20px auto;
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    
    h2 {
        color: #2307beff;
        text-align: center;
        margin-bottom: 30px;
    }
    
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    td {
        padding: 12px;
    }
    
    tr:nth-child(even) {
        background-color: #f8fbff;
    }
    
    input[type="text"], 
    input[type="email"], 
    input[type="password"], 
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #cce5ff;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }
    
    input[type="file"] {
        padding: 5px;
    }
    
    input[type="submit"] {
        background-color: #1707f1ff;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        margin-top: 15px;
        transition: background-color 0.3s;
    }
    
    input[type="submit"]:hover {
        background-color: #1707f1ff;
    }
    
    .required:after {
        content: " *";
        color: red;
    }
    /* .home{
      text-decoration: none;
    padding: 10px 38px;
    border-radius: 5px;
    background: #2008a7;
    color: white;
    } */
</style>
</head>

<body>
<div class="container">
       <tr>
          <td align="center" colspan="2"><a href="../index.php" class="home" style="float: right;">Home</a></td>
        </tr>
    <h2>User Registration</h2>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table>
        <tr>
          <!-- <td width="30%" class="required">NAME</td> -->
          <td width="70%"><label for="txt_name"></label>
          <input type="text" name="txt_name" id="txt_name" maxlength="15" required placeholder="Enter name" title="Name Allows Only 15 Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$"
/></td>
        </tr>
        <tr>
          <!-- <td class="required">EMAIL</td> -->
          <td><label for="txt_email"></label>
          <input type="email" name="txt_email" id="txt_email" maxlength="30" required placeholder="Enter email" /></td>
        </tr>
        <tr>
          <!-- <td class="required">CONTACT</td> -->
          <td><label for="txt_contact"></label>
          <input type="text" name="txt_contact" id="txt_contact" maxlength="10" pattern="^[6-9]\d{9}$" required placeholder="Enter contact" title="Allows only 10 numbers type a valid number"/></td>
        </tr>
       <style>
/* Hide the default file input */
input[type="file"] {
  display: none;
}

/* Style custom labels as buttons */
.custom-file-label {
  background-color: #007bff;
  color: white;
  padding: 8px 14px;
  border-radius: 6px;
  cursor: pointer;
  display: inline-block;
  font-size: 14px;
  transition: background 0.3s;
}

.custom-file-label:hover {
  background-color: #0056b3;
}

/* Optional: show selected filename */
.file-name {
  margin-left: 10px;
  font-size: 14px;
  color: #333;
}
</style>

<tr>
  <td>
    <!-- <label>Upload Logo:</label><br> -->
    <label for="file_photo" class="custom-file-label">Choose photo</label>
    <input type="file" name="file_photo" id="file_photo" accept=".jpg, .jpeg, .png, .webp" required>
    <span class="file-name" id="logo-name"></span>
  </td>
</tr>


<script>
// Display selected file names
document.getElementById('file_photo').addEventListener('change', function() {
  document.getElementById('logo-name').textContent = this.files[0]?.name || '';
});
</script>

        <tr>
          <!-- <td class="required">STATE</td> -->
          <td><label for="scl_state"></label>
            <select name="scl_state" id="scl_state" onChange="getDistrict(this.value)" required>
             <option value="">Select State</option>
            <?php
      $sel="select * from tbl_state where state_status=1 ORDER BY state_name ASC";
        $row = $con->query($sel);
        while($data = $row->fetch_assoc())
        
        {
      ?>
      <option value="<?php echo $data['state_id']?>">
      <?php echo $data['state_name'] ?></option>
      <?php
        }
        ?>
          </select></td>
        </tr>
        <tr>
          <!-- <td class="required">DISTRICT</td> -->
          <td><label for="scl_district"></label>
            <select name="scl_district" id="scl_district" onChange="getPlace(this.value)" required>
            <option value="">Select District</option>
          </select></td>
        </tr>
        <tr>
          <!-- <td class="required">PLACE</td> -->
          <td><label for="scl_place"></label>
            <select name="scl_place" id="scl_place" required>
            <option value="">Select Place</option>
          </select></td>
        </tr>
        <tr>
          <!-- <td class="required">PASSWORD</td> -->
          <td><label for="txt_password"></label>
          <input type="password" name="txt_password" id="txt_password" required placeholder="Enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Register" /></td>
        </tr>
      </table>
    </form>
</div>
</body>
</html>
<script src="../Assets/JQ/jQuery.js"></script> 


<script>
    function getDistrict(sid) 
    {
        $.ajax({
        url:"../Assets/Ajaxpages/AjaxDistrict.php?sid="+sid,
        success: function(result){
            $("#scl_district").html(result);
        }
        });
    }
    function getPlace(did) 
    {
        $.ajax({
        url:"../Assets/Ajaxpages/AjaxPlace.php?did="+did,
        success: function(result){
            $("#scl_place").html(result);
        }
        });
    }
</script>
<?php
include('Footer.php');
?>