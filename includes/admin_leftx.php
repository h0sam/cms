<?php  include_once"../includes/config.php";?>

<table width="100%" border="1" cellpadding="0" cellspacing="0" class="adminleftmenu">
    <tr>
     <td class="menunumber"><a href="image_category.php" class="menulink">Image Categories</a></td>
  </tr>
    <tr>
     <td class="menunumber"><?php category_map();?></td>
  </tr>
  <tr>
     <td class="menunumber"><a href="video_category.php" class="menulink">Video Categories</a></td>
  </tr>


  <tr><td class="menunumber">
  <?php
     $category_query = mysql_query("SELECT * FROM video_category ORDER By category_id DESC") or die(mysql_error());
     
	 $category_num = mysql_num_rows($category_query);
	 if($category_num)
	 {
	   echo"<ul>";
		 while($category_row=mysql_fetch_array($category_query))
		 {
	?>
		<li>	
    		<a  href="video_library.php?cat_id=<?php echo $category_row[category_id];?>" class="menulink"><?php echo $category_row[category_name];?></a>
  		</li>					 
  <?php
		 }
	echo"</ul>";
	 }
  ?>
  </td></tr>
   <tr>
     <td class="menunumber"><a href="departments.php" class="menulink">Departments</a></td>
  </tr>
  <tr>
     <td class="menunumber"><a href="users.php" class="menulink">List Employees</a></td>
  </tr>
  <tr>
     <td class="menunumber"><a href="employee_leaves.php" class="menulink">Employee Leaves</a></td>
  </tr>
  
  <tr>
     <td class="menunumber"><a href="job_category.php" class="menulink">Job Categories</a></td>
  </tr>

</table>