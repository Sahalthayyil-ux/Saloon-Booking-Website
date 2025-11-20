<?php
include("../Assets/Connection/Connection.php");

if(isset($_POST["btn_submit"]))
{
    
    $name = $_POST["txt_name"];
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];
    $ownername = $_POST["txt_ownername"];
    $gstno = $_POST["txt_gstno"];
    $contact=$_POST["txt_contact"];
    $address=$_POST["txt_address"];
    $logo=$_FILES['file_logo']['name'];
    $path=$_FILES['file_logo']['tmp_name'];
    move_uploaded_file($path,'../Assets/Files/User/logo/'.$logo);
    $proof=$_FILES['file_proof']['name'];
    $path=$_FILES['file_proof']['tmp_name'];
    move_uploaded_file($path,'../Assets/Files/User/proof/'.$proof);
    $place=$_POST["scl_place"];

    if($logo == "" || $proof == "")
    {
      ?>
      <script>
        alert('Please Select Logo or Proof...')
      </script>
      <?php
    }
    else{
      $sel = "select * from tbl_saloon where saloon_email='".$email."'";
      $row = $con->query($sel);
      $sel1 = "select * from tbl_user where user_email='".$email."'";
      $row1 = $con->query($sel1);
      if($row->num_rows>0 || $row1->num_rows>0)
      {
          ?>
          <script>
          alert("Email already exists..")
          window.location="SaloonRegistration.php"
          </script>
          <?php
      }
      else
      {
      $ins = "insert into tbl_saloon(saloon_name,saloon_email,saloon_contact,saloon_password,saloon_logo,saloon_address,saloon_proof,place_id,saloon_ownername,saloon_gstno,saloon_doj) values('".$name."','".$email."','".$contact."','".$password."','".$logo."','".$address."','".$proof."','".$place."','".$ownername."','".$gstno."',curdate())";
      
      if($con->query($ins))
      {
          ?>
          <script>
          alert("Data inserted..")
          window.location="SaloonRegistration.php"
          </script>
          <?php    
        }
      }
    }
  }
 
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Saloon Registration</title>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    position: relative;
}

body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url("../Assets/Templates/Images/salon bg image.jpg");
    background-size: cover;
    background-position: center;
    filter: blur(8px);
    z-index: -1;
}
    .container {
        max-width: 400px;
        margin: 0 auto;
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }
    
    h2 {
        color: #3809e4ff;
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
    textarea, 
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
        background-color: #2008a7ff;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        margin-top: 15px;
    }
    
    input[type="submit"]:hover {
        background-color: #1707a8ff;
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
    <h2>Saloon Registration Form</h2>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table>
        <tr>
          <!-- <td width="30%" class="required">NAME</td> -->
          <td width="70%"><label for="txt_name"></label>
          <input type="text" name="txt_name" id="txt_name" maxlength="25" required placeholder="Enter Name" title="Name Allows Only 15 Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z &/]*$"/></td>
        </tr>
        <tr>
          <!-- <td class="required">EMAIL</td> -->
          <td><label for="txt_email"></label>
          <input type="email" name="txt_email" id="txt_email" maxlength="30" required placeholder="Enter email" pattern="^[a-z0-9._%+-]+@gmail\.com$"/></td>
        </tr>
        <tr>
          <!-- <td class="required">CONTACT</td> -->
          <td><label for="txt_contact"></label>
          <input type="text" name="txt_contact" id="txt_contact" maxlength="10" pattern="^[6-9]\d{9}$" required placeholder="Enter contact" title="Allows only 10 numbers and must be a valid number"/></td>
        </tr>
        <tr>
          <!-- <td class="required">OWNER NAME</td> -->
          <td><label for="txt_ownername"></label>
          <input type="text" name="txt_ownername" id="txt_ownername" maxlength="25" pattern="^[A-Z]+[a-zA-Z ]*$" required placeholder="Enter owner name" title="Allows only Alphabets"/></td>
        </tr>
        <tr>
          <!-- <td class="required">GSTNO</td> -->
          <td><label for="txt_gstno"></label>
          <input type="text" name="txt_gstno" id="txt_gstno" required placeholder="Enter Gstno"/>
          </td>
        </tr>
        <tr>
          <!-- <td class="required">ADDRESS</td> -->
          <td><label for="txt_address"></label>
          <textarea name="txt_address" id="txt_address" cols="45" rows="5" maxlength="55" required placeholder="Enter Address"></textarea></td>
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
    <label for="file_logo" class="custom-file-label">Choose Photo</label>
    <input type="file" name="file_logo" id="file_logo" accept=".jpg, .jpeg, .png, .webp" >
    <span class="file-name" id="logo-name"></span>
  </td>
</tr>

<tr>
  <td>
    <!-- <label>Upload Proof Document:</label><br> -->
    <label for="file_proof" class="custom-file-label">Choose Proof</label>
    <input type="file" name="file_proof" id="file_proof" accept=".jpg, .jpeg, .png, .webp" >
    <span class="file-name" id="proof-name"></span>
  </td>
</tr>

<script>
// Display selected file names
document.getElementById('file_logo').addEventListener('change', function() {
  document.getElementById('logo-name').textContent = this.files[0]?.name || '';
});
document.getElementById('file_proof').addEventListener('change', function() {
  document.getElementById('proof-name').textContent = this.files[0]?.name || '';
});
</script>

        <tr>
          <!-- <td class="required">STATE</td> -->
          <td><label for="scl_state"></label>
            <select name="scl_state" id="scl_state" onChange="getDistrict(this.value)" required="required">
             <option value="">Select State</option>
            <?php
      $sel="select * from tbl_state where state_status=1 ORDER BY state_name ASC";
        $row = $con->query($sel);
        while($data = $row->fetch_assoc())
        
        {
      ?>
      <option 
      value="<?php echo $data['state_id']?>">
      <?php echo $data['state_name'] ?></option>
      <?php
        }
        ?>
          </select></td>
        </tr>
        <tr>
          <!-- <td class="required">DISTRICT</td> -->
          <td><label for="scl_district"></label>
            <select name="scl_district" id="scl_district" onChange="getPlace(this.value)" required="required">
             <option value="">Select District</option>
          </select></td>
        </tr>
        <tr>
          <!-- <td class="required">PLACE</td> -->
          <td><label for="scl_place"></label>
            <select name="scl_place" id="scl_place" required="required">
            <option value="">Select Place</option>
          </select></td>
        </tr>
        <tr>
          <!-- <td class="required">PASSWORD</td> -->
          <td><label for="txt_password"></label>
          <input type="password" name="txt_password" id="txt_password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required placeholder="Enter password"/></td>
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