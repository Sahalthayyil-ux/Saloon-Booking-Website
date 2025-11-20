<?php
include("../Assets/Connection/Connection.php");
include('Header.php');

$pid = "";
$pname = "";
$did = "";

if (isset($_POST["btn_submit"])) {
    $place = $_POST["txt_place"];
    $state = $_POST['sel_state'];
    $district = $_POST['sel_dis'];
    $pid = $_POST["txt_id"];

    if ($pid == "") {
        $selQry = "SELECT * FROM tbl_place WHERE place_status=1 AND place_name='" . $place . "' AND district_id='" . $district . "'";
        $res = $con->query($selQry);
        if ($data = $res->fetch_assoc()) {
            ?>
            <script>alert("Place already exists");</script>
            <?php
        } else {
            $ins = "INSERT INTO tbl_place(place_name,district_id) VALUES('" . $place . "','" . $district . "')";
            if ($con->query($ins)) {
                ?>
                <script>
                    alert("Data inserted..")
                    window.location = "Place.php"
                </script>
                <?php
            }
        }
    } else {
        $upQry = "UPDATE tbl_place SET place_name='" . $place . "',district_id='" . $district . "' WHERE place_id='" . $pid . "'";
        if ($con->query($upQry)) {
            ?>
            <script>
                alert("Data updated..")
                window.location = "Place.php"
            </script>
            <?php
        }
    }
}

if (isset($_GET["delid"])) {
    $upQry = "UPDATE tbl_place SET place_status=0 WHERE place_id='" . $_GET["delid"] . "'";
    if ($con->query($upQry)) {
        ?>
        <script>
            alert("Data deleted..")
            window.location = "Place.php"
        </script>
        <?php
    }
}
 if(isset($_GET['edid']))
 {
 $sel="select * from tbl_place where place_id= '".$_GET['edid']."'";
 $row=$con->query($sel);
 $data=$row->fetch_assoc();
 $pname=$data['place_name'];
 $pid=$data['place_id'];
 $did=$data['disrtict_id'];
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Place Management</title>

<style>
/* Red, Black, White Theme */
:root{
  --red:#1616eb;
  --black:#0b0b0b;
  --white:#ffffff;
  --muted:#2b2b2b;
}
*{margin:0;padding:0;box-sizing:border-box;font-family:"Segoe UI",Arial,sans-serif;}

body{
  background:var(--white);
  color:var(--black);
  /* padding:24px; */
}

.container{
  max-width:1100px;
  margin:auto;
}

/* Card */
.card{
  background:var(--white);
  border:2px solid var(--red);
  border-radius:10px;
  box-shadow:0 6px 16px rgba(0,0,0,0.08);
  margin-bottom:30px;
  overflow:hidden;
}
.card-header{
  background:var(--red);
  color:var(--white);
  padding:14px 18px;
  font-size:18px;
  font-weight:600;
}
.card-body{
  padding:20px;
}

/* Form */
form label{font-weight:600;color:var(--black);}
form select,form input[type="text"]{
  width:100%;
  padding:10px 12px;
  margin:8px 0 18px 0;
  border:1px solid var(--muted);
  border-radius:6px;
  font-size:14px;
}
form select:focus,form input[type="text"]:focus{
  outline:none;
  border-color:var(--red);
  box-shadow:0 0 0 2px rgba(193,0,0,0.2);
}
.btn-submit{
  background:var(--black);
  color:var(--white);
  padding:10px 18px;
  border:none;
  border-radius:6px;
  font-weight:600;
  cursor:pointer;
  transition:0.2s;
}
.btn-submit:hover{
  background:var(--red);
}

/* Table */
.table-wrap{
  overflow:auto;
}
table{
  width:100%;
  border-collapse:collapse;
  font-size:14px;
  min-width:600px;
}
thead th{
  background:var(--black);
  color:var(--white);
  padding:12px 14px;
  text-align:left;
}
tbody td{
  padding:12px 14px;
  border-bottom:1px solid #ddd;
  color:var(--muted);
}
tbody tr:nth-child(even){background:rgba(193,0,0,0.03);}
tbody tr:hover{background:rgba(193,0,0,0.07);}
.action-link{
  display: inline-block;
  color:var(--red);
  font-weight:600;
  text-decoration:none;
}
.action-link:hover{text-decoration:underline;}
.action-edit {
    color: #333;
  }
</style>
</head>

<body>
<div class="container">
  <!-- Form -->
  <div class="card">
    <div class="card-header">Add / Update Place</div>
    <div class="card-body">
      <form method="post">
        <label for="sel_state">State</label>
        <select name="sel_state" id="sel_state" onChange="getDistrict(this.value)" required>
          <option value="">Select State</option>
          <?php
          $sel = "SELECT * FROM tbl_state WHERE state_status=1 ORDER BY state_name ASC";
          $row = $con->query($sel);
          while ($data = $row->fetch_assoc()) {
              ?>
              <option value="<?php echo $data['state_id']; ?>"><?php echo $data['state_name']; ?></option>
              <?php
          }
          ?>
        </select>

        <label for="sel_dis">District</label>
        <select name="sel_dis" id="sel_dis" required>
          <option value="">Select District</option>
        </select>

        <label for="txt_place">Place</label>
        <input type="hidden" name="txt_id" value="<?php echo $pid; ?>"/>
        <input type="text" name="txt_place" id="txt_place" maxlength="30" value="<?php echo $pname; ?>" required 
               placeholder="Enter place name"
               pattern="^[A-Z]+[a-zA-Z ]*$"
               title="Only alphabets, spaces, first letter capital."/>

        <button type="submit" name="btn_submit" class="btn-submit">Submit</button>
      </form>
    </div>
  </div>

  <!-- Table -->
  <div class="card">
    <div class="card-header">Place List</div>
    <div class="card-body table-wrap">
      <table>
        <thead>
          <tr>
            <th>SINO</th>
            <th>STATE</th>
            <th>DISTRICT</th>
            <th>PLACE</th>
            <th>ACTION</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        $sel = "SELECT * FROM tbl_place p 
                INNER JOIN tbl_district d ON p.district_id=d.district_id 
                INNER JOIN tbl_state s ON d.state_id=s.state_id 
                WHERE p.place_status=1 ORDER BY state_name ASC";
        $row = $con->query($sel);
        while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $data["state_name"]; ?></td>
              <td><?php echo $data["district_name"]; ?></td>
              <td><?php echo $data["place_name"]; ?></td>
              <td><a class="action-link" href="Place.php?delid=<?php echo $data['place_id']; ?>">Delete</a>
                  <a href="place.php?edid=<?php echo $data['place_id']?>" class="action-link action-edit">Edit</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="../Assets/JQ/jQuery.js"></script> 
<script>
function getDistrict(sid){
  $.ajax({
    url:"../Assets/Ajaxpages/AjaxDistrict.php?sid="+sid,
    success:function(result){
      $("#sel_dis").html(result);
    }
  });
}
</script>
</body>
</html>

<?php include('Footer.php'); ?>
