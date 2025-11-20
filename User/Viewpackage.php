<?php
include("../Assets/Connection/Connection.php");
include('SessionValidation.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Packages</title>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }
  
  body {
    background-color: #f5f7fa;
    color: #2c3e50;
    line-height: 1.6;
    padding: 20px;
  }
  
  .container {
    max-width: 1200px;
    margin: 30px auto;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }
  
  .header {
    background: #1a5276;
    color: white;
    padding: 25px;
    text-align: center;
  }
  
  .header h2 {
    font-size: 28px;
    font-weight: 600;
  }
  
  .packages-container {
    padding: 30px;
  }
  
  .packages-table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .packages-table th {
    background-color: #3498db;
    color: white;
    padding: 15px;
    text-align: left;
    font-weight: 600;
  }
  
  .packages-table td {
    padding: 15px;
    border-bottom: 1px solid #eaeaea;
    vertical-align: top;
  }
  
  .packages-table tr:nth-child(even) {
    background-color: #f8f9fa;
  }
  
  .packages-table tr:hover {
    background-color: #e9f7fe;
  }
  
  .package-image {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 5px;
    border: 3px solid #fff;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
  }
  
  .package-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 18px;
  }
  
  .package-description {
    color: #34495e;
    margin-top: 5px;
    line-height: 1.5;
  }
  
  .package-amount {
    font-weight: 600;
    color: #1a5276;
    font-size: 18px;
  }
  
  .book-btn {
    display: inline-block;
    padding: 10px 20px;
    background: #1a5276;
    color: white;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    transition: background 0.3s;
  }
  
  .book-btn:hover {
    background: #2c3e50;
  }
  
  .no-packages {
    text-align: center;
    padding: 30px;
    color: #7f8c8d;
    font-style: italic;
  }
  
  @media (max-width: 768px) {
    .packages-table {
      display: block;
      overflow-x: auto;
    }
    
    .packages-table th, 
    .packages-table td {
      padding: 10px;
    }
    
    .package-image {
      width: 100px;
      height: 100px;
    }
  }
</style>
</head>

<body>
<div class="container">
  <div class="header">
    <h2>Available Packages</h2>
  </div>
  
  <div class="packages-container">
    <form id="form1" name="form1" method="post" action="">
      <table class="packages-table">
        <tr>
          <th>SI No</th>
          <th>Photo</th>
          <th>Name</th>
          <th>Description</th>
          <th>Amount</th>
          <th>Action</th>
        </tr>
        <?php
        $i = 0;
        $sel="select * from tbl_package where package_status=1 and saloon_id='".$_GET['sid']."'";
        $row = $con->query($sel);
        
        if($row->num_rows > 0) {
          while($data = $row->fetch_assoc())
          {
            $i++;
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><img src="../Assets/Files/saloon/package/<?php echo $data["package_photo"];?>" class="package-image" alt="Package Image"/></td>
            <td>
              <div class="package-name"><?php echo $data["package_name"]; ?></div>
            </td>
            <td>
              <div class="package-description"><?php echo $data["package_description"]; ?></div>
            </td>
            <td>
              <div class="package-amount">₹<?php echo $data["package_amount"]; ?></div>
            </td>
            <td><a href="Viewslot.php?pid=<?php echo $data['package_id'] ?>" class="book-btn">BOOK NOW</a></td>
          </tr>
          <?php
          }
        } else {
          echo '<tr><td colspan="6" class="no-packages">No packages available at this time.</td></tr>';
        }
        ?>
      </table>
    </form>
  </div>
</div>
</body>
</html>