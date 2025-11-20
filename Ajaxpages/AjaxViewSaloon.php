<?php 
include("../Connection/Connection.php");
?>
<table border="1">
    <tr>
      <td>SINO</td>
      <td>NAME</td>
      <td>LOGO</td>
      <td>CONTACT</td>
      <td>EMAIL</td>
      <td>ADDRESS</td>
      <td>STATE</td>
      <td>DISTRICT</td>
      <td>PLACE</td>
      <td>RATEING</td>
      <td>ACTION</td>
    </tr>
     <?php
	$i = 0;
	if($_GET['pid']!="")
	{
		$sel="select * from tbl_saloon u INNER JOIN tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_state s on d.state_id=s.state_id where saloon_status=1 and u.place_id=".$_GET['pid'];
	}
	else if($_GET['did']!="")
	{
		$sel="select * from tbl_saloon u INNER JOIN tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_state s on d.state_id=s.state_id where saloon_status=1 and p.district_id=".$_GET['did'];
	}
	else if($_GET['sid']!="")
	{
		$sel="select * from tbl_saloon u INNER JOIN tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_state s on d.state_id=s.state_id where saloon_status=1 and d.state_id=".$_GET['sid'];
	}
	else
	{
		$sel="select * from tbl_saloon u INNER JOIN tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id inner join tbl_state s on d.state_id=s.state_id where saloon_status=1";
	}
	$rowss = $con->query($sel);
	while($data = $rowss->fetch_assoc())
	{
		$i++;
	  ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data["saloon_name"];?></td>
      <td><img src="../Assets/Files/User/logo/<?php echo $data["saloon_logo"];?>" width="150" height="150"/></td>
      <td><?php echo $data["saloon_contact"];?></td>
      <td><?php echo $data["saloon_email"];?></td>
      <td><?php echo $data["saloon_address"];?></td>
      <td><?php echo $data["state_name"];?></td>
      <td><?php echo $data["district_name"];?></td>
      <td><?php echo $data["place_name"];?></td>
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
											$review_content = array();
										
											$query = "SELECT * FROM tbl_review where saloon_id = '".$data["saloon_id"]."' ORDER BY review_id DESC";
										
											$result = $con->query($query);
										
											while($row = $result->fetch_assoc())
											{
												
										
												if($row["user_rating"] == '5')
												{
													$five_star_review++;
												}
										
												if($row["user_rating"] == '4')
												{
													$four_star_review++;
												}
										
												if($row["user_rating"] == '3')
												{
													$three_star_review++;
												}
										
												if($row["user_rating"] == '2')
												{
													$two_star_review++;
												}
										
												if($row["user_rating"] == '1')
												{
													$one_star_review++;
												}
										
												$total_review++;
										
												$total_user_rating = $total_user_rating + $row["user_rating"];
										
											}
											
											
											if($total_review==0 || $total_user_rating==0 )
											{
												$average_rating = 0 ; 			
											}
											else
											{
												$average_rating = $total_user_rating / $total_review;
											}
											
											?>
                                            <p align="center" style="color:#F96;font-size:20px">
                                           <?php
										   if($average_rating>=5)
										   {
											   ?>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                               <?php
										   }
										   if($average_rating>=4 && $average_rating<5)
										   {
											   ?>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                               <?php
										   }
										   if($average_rating>=3 && $average_rating<4)
										   {
											   ?>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                               <?php
										   }
										   if($average_rating>=2 && $average_rating<3)
										   {
											   ?>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                               <?php
										   }
										   if($average_rating>=1 && $average_rating<2)
										   {
											   ?>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#FC3"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                               <?php
										   }
										   if($average_rating==0)
										   {
											   ?>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                                <i class="fas fa-star star-light mr-1 main_star" style="color:#999"></i>
                                               <?php
										   }
										   ?>
                                           
                                        </p>
                                            <?php
										
											$output = array(
												'average_rating'	=>	number_format($average_rating, 1),
												'total_review'		=>	$total_review,
												'five_star_review'	=>	$five_star_review,
												'four_star_review'	=>	$four_star_review,
												'three_star_review'	=>	$three_star_review,
												'two_star_review'	=>	$two_star_review,
												'one_star_review'	=>	$one_star_review,
												'review_data'		=>	$review_content
											);
										
											
	  ?>
      </td>
      <td><p><a href="Viewpackage.php?sid=<?php echo $data['saloon_id'] ?>">VIEW PACKAGE </a></p>
        <p>
      <a href="Book.php?rid=<?php echo $data['saloon_id'] ?>">BOOK</a></p></td>
    </tr>
     <?php
	}
	?>
  </table>