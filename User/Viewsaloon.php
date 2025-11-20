<?php
include("../Assets/Connection/Connection.php");
include('Header.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Salons</title>
<!-- Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
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
    max-width: 1400px;
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
  
  .filter-section {
    padding: 20px;
    background: #f8f9fa;
    border-bottom: 1px solid #eaeaea;
  }
  
  .filter-table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .filter-table td {
    padding: 10px;
    vertical-align: middle;
  }
  
  .filter-label {
    font-weight: 600;
    color: #2c3e50;
    white-space: nowrap;
    padding-right: 10px;
  }
  
  select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    background: white;
    color: #2c3e50;
  }
  
  select:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
  }
  
  .salons-container {
    padding: 20px;
    overflow-x: auto;
  }
  
  .salons-table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .salons-table th {
    background-color: #3498db;
    color: white;
    padding: 15px;
    text-align: left;
    font-weight: 600;
  }
  
  .salons-table td {
    padding: 15px;
    border-bottom: 1px solid #eaeaea;
    vertical-align: top;
  }
  
  .salons-table tr:nth-child(even) {
    background-color: #f8f9fa;
  }
  
  .salons-table tr:hover {
    background-color: #e9f7fe;
  }
  
  .salon-logo {
    width: 150px;
    height: 150px;
    object-fit: cover;
    border-radius: 5px;
    border: 3px solid #fff;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
  }
  
  .salon-name {
    font-weight: 600;
    color: #2c3e50;
    font-size: 18px;
    margin-bottom: 5px;
  }
  
  .salon-contact, .salon-email {
    color: #34495e;
    margin-bottom: 5px;
  }
  
  .salon-address {
    color: #7f8c8d;
    font-style: italic;
  }
  
  .location-info {
    color: #34495e;
    margin-bottom: 3px;
  }
  
  .rating-stars {
    text-align: center;
    margin-bottom: 10px;
  }
  
  .rating-text {
    text-align: center;
    font-size: 14px;
    color: #7f8c8d;
  }
  
  .action-buttons {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  
  /* .action-btn {
    display: inline-block;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    text-align: center;
    transition: all 0.3s;
  }
  
  .btn-view {
    background: #1a5276;
    color: white;
  } */
  
  /* .btn-view:hover {
    background: #2c3e50;
  }
  
  .btn-book {
    background: #27ae60;
    color: white;
  }
  
  .btn-book:hover {
    background: #219653;
  }
  
  .no-salons {
    text-align: center;
    padding: 30px;
    color: #7f8c8d;
    font-style: italic;
  } */
  

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
  @media (max-width: 1200px) {
    .filter-table {
      display: block;
    }
    
    .filter-table tr {
      display: flex;
      flex-wrap: wrap;
      margin-bottom: 10px;
    }
    
    .filter-table td {
      flex: 1 0 33%;
    }
  }
  
  @media (max-width: 768px) {
    .salons-table {
      display: block;
      overflow-x: auto;
    }
    
    .salons-table th, 
    .salons-table td {
      padding: 10px;
    }
    
    .salon-logo {
      width: 100px;
      height: 100px;
    }
    
    .action-buttons {
      flex-direction: row;
      justify-content: center;
    }
  }
</style>
</head>

<body>
<div class="container">
  <div class="header">
    <h2>Find Your Perfect Salon</h2>
  </div>
  
  <div class="filter-section">
    <form id="form1" name="form1" method="post" action="">
      <table class="filter-table">
        <tr>
          <td class="filter-label">STATE</td>
          <td>
            <select name="scl_state" id="scl_state" onChange="getDistrict(this.value),getSaloon()" required="required">
              <option value="">Select State</option>
              <?php
              $sel="select * from tbl_state where state_status=1 ORDER BY state_name ASC";
              $row = $con->query($sel);
              while($data = $row->fetch_assoc()) {
              ?>
              <option value="<?php echo $data['state_id']?>">
                <?php echo $data['state_name'] ?>
              </option>
              <?php } ?>
            </select>
          </td>
          
          <td class="filter-label">DISTRICT</td>
          <td>
            <select name="scl_district" id="scl_district" onChange="getPlace(this.value),getSaloon()" required="required">
              <option value="">Select District</option>
            </select>
          </td>
          
          <td class="filter-label">PLACE</td>
          <td>
            <select name="scl_place" id="scl_place" required="required" onchange="getSaloon()">
              <option value="">Select Place</option>
            </select>
          </td>
        </tr>
      </table>
    </form>
  </div>
  
  <div class="salons-container">
    <table class="salons-table" id="result">
      <tr>
        <th>SI No</th>
        <th>Name</th>
        <th>Logo</th>
        <th>Contact Info</th>
        <th>Address</th>
        <th>Location</th>
        <th>Rating</th>
        <th>Action</th>
      </tr>
      <?php
      $i = 0;
      $sel="select * from tbl_saloon u INNER JOIN tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_state s on d.state_id=s.state_id where saloon_status=1 ORDER BY state_name ASC";
      $rowss = $con->query($sel);
      
      if($rowss->num_rows > 0) {
        while($data = $rowss->fetch_assoc()) {
          $i++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td>
          <div class="salon-name"><?php echo $data["saloon_name"];?></div>
        </td>
        <td>
          <img src="../Assets/Files/User/logo/<?php echo $data["saloon_logo"];?>" class="salon-logo" alt="Salon Logo"/>
        </td>
        <td>
          <div class="salon-contact"><i class="fas fa-phone"></i> <?php echo $data["saloon_contact"];?></div>
          <div class="salon-email"><i class="fas fa-envelope"></i> <?php echo $data["saloon_email"];?></div>
        </td>
        <td>
          <div class="salon-address"><i class="fas fa-map-marker-alt"></i> <?php echo $data["saloon_address"];?></div>
        </td>
        <td>
          <div class="location-info"><strong>State:</strong> <?php echo $data["state_name"];?></div>
          <div class="location-info"><strong>District:</strong> <?php echo $data["district_name"];?></div>
          <div class="location-info"><strong>Place:</strong> <?php echo $data["place_name"];?></div>
        </td>
        <td>
          <?php
          $average_rating = 0;
          $total_review = 0;
          $five_star_review = 0;
          $four_star_review = 0;
          $three_star_review = 0;
          $two_star_review = 0;
          $one_star_review = 0;
          $total_user_rating = 0;
          
          $query = "SELECT * FROM tbl_review where saloon_id = '".$data["saloon_id"]."' ORDER BY review_id DESC";
          $result = $con->query($query);
          
          while($row = $result->fetch_assoc()) {
            if($row["user_rating"] == '5') $five_star_review++;
            if($row["user_rating"] == '4') $four_star_review++;
            if($row["user_rating"] == '3') $three_star_review++;
            if($row["user_rating"] == '2') $two_star_review++;
            if($row["user_rating"] == '1') $one_star_review++;
            
            $total_review++;
            $total_user_rating = $total_user_rating + $row["user_rating"];
          }
          
          if($total_review > 0 && $total_user_rating > 0) {
            $average_rating = $total_user_rating / $total_review;
          }
          ?>
          <div class="rating-stars">
            <?php
            for($j = 1; $j <= 5; $j++) {
              if($j <= floor($average_rating)) {
                echo '<i class="fas fa-star" style="color:#FC3"></i>';
              } else {
                echo '<i class="fas fa-star" style="color:#999"></i>';
              }
            }
            ?>
          </div>
          <div class="rating-text">
            <?php echo number_format($average_rating, 1); ?> (<?php echo $total_review; ?> reviews)
          </div>
        </td>
        <td>
          <div class="action-buttons">
            <a href="Viewpackage.php?sid=<?php echo $data['saloon_id'] ?>" class="custom-file-label">VIEW PACKAGES</a>
            <a href="Book.php?rid=<?php echo $data['saloon_id'] ?>" class="custom-file-label">BOOK NOW</a>
          </div>
        </td>
      </tr>
      <?php
        }
      } else {
        echo '<tr><td colspan="8" class="no-salons">No salons found. Please try different filters.</td></tr>';
      }
      ?>
    </table>
  </div>
</div>

<script src="../Assets/JQ/jQuery.js"></script> 
<script>
    function getDistrict(sid) {
        $.ajax({
          url:"../Assets/Ajaxpages/AjaxDistrict.php?sid="+sid,
          success: function(result){
            $("#scl_district").html(result);
          }
        });
    }
    
    function getPlace(did) {
        $.ajax({
          url:"../Assets/Ajaxpages/AjaxPlace.php?did="+did,
          success: function(result){
            $("#scl_place").html(result);
          }
        });
    }
    
    function getSaloon() {
      var sid = document.getElementById('scl_state').value
      var did = document.getElementById('scl_district').value
      var pid = document.getElementById('scl_place').value
      
      $.ajax({
        url:"../Assets/Ajaxpages/AjaxViewSaloon.php?did="+did+"&sid="+sid+"&pid="+pid,
        success: function(result){
          $("#result").html(result);
        }
      });
    }
</script>
</body>
</html>
<?php
include('Footer.php');
?>