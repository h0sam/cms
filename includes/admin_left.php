<?php  include_once"../includes/config.php";?>
<img src="../admin/images/logo.gif" alt="" width="126" height="166" align="absmiddle">
<table width="234" border="1" cellpadding="0" cellspacing="0" class="adminleftmenu">

<tr >
        <th width="234" height="29" background="images/main-menu.jpg" class="recentevent"> WASCO Content</th>
  </tr>

   <?php $site_category_query=mysql_query("SELECT * FROM site_category  ORDER BY category_id ASC")or die(mysql_error());
    while($site_category_row=mysql_fetch_array($site_category_query)){
 ?>
  <tr style=" background:url(images/menu-bg.jpg); ">
    <td height="29" style="padding-left:25px;">
    <a href="content.php?category_id=<?php echo $site_category_row['category_id']?>&category_name=<?php echo Encrypt($site_category_row['category_name'])?>" class="link_left_sub"><b><?php echo $site_category_row['category_name']?></a>
    </td>
  </tr>
  <?php }?>
    <tr>

     <th><a href="image_category.php" class="link_left_main">Image Categories</a></th>

</tr>

    <tr>

     <td height="29" style="padding-left:25px;"><?php category_map();?></td>

  </tr>

  <tr>

     <th><a href="video_category.php"  class="link_left_main">Video Categories</a></th>

  </tr>





  <tr><td height="29" style="padding-left:25px;">

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

    		<a  href="video_library.php?cat_id=<?php echo $category_row[category_id];?>"  class="link_left_sub"><?php echo $category_row[category_name];?></a>

  		</li>					 

  <?php

		 }

	echo"</ul>";

	 }

  ?>

  </td></tr>

   <tr>

     <td height="29" style="padding-left:25px;"><a href="departments.php" class="link_left_sub">Departments</a></td>

  </tr>

  <tr>

     <td height="29" style="padding-left:25px;"><a href="users.php"  class="link_left_sub">List Employees</a></td>

  </tr>

  <tr>

     <td height="29" style="padding-left:25px;"><a href="employee_leaves.php" class="link_left_sub">Employee Leaves</a></td>

  </tr>
  
  <tr>
     <td height="29" style="padding-left:25px;"><a href="job_category.php" class="link_left_sub">Job Category</a></td>
  </tr>
  
  <tr>
     <td height="29" style="padding-left:25px;"><a href="news.php" class="link_left_sub">News</a></td>
  </tr>
  
  <tr>
     <td height="29" style="padding-left:25px;"><a href="courses.php" class="link_left_sub">Training Courses</a></td>
  </tr>
  
  <tr>
     <td height="29" style="padding-left:25px;"><a href="reports.php" class="link_left_sub">Annual Reports</a></td>
  </tr>  
  
  <tr>
     <td height="29" style="padding-left:25px;"><a href="presentations.php" class="link_left_sub">Presentations </a></td>
  </tr>
  <tr>
     <td height="29" style="padding-left:25px;"><a href="faq.php" class="link_left_sub">Help </a></td>
  </tr>


</table>
