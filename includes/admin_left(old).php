<?php  include_once"../includes/config.php";?>

<table width="100%" border="1" cellpadding="0" cellspacing="0" class="adminleftmenu">
    <tr>
    <td class="recentevent"><a href="../admin/image_parent.php" class="newstitle">Image Parent Categories</a></td>
  </tr>
    
    <tr>
    <td class="recentevent"><a href="../admin/image_parent_add.php" class="newstitle">Add Image Parent Category</a></td>
  </tr>
    
    <tr>
    <td class="recentevent"><a href="../admin/image_category.php" class="newstitle">Image Categories</a></td>
  </tr>
  
  <tr>
    <td class="recentevent"><a href="../admin/image_category_add.php" class="newstitle">Add Image Category</a></td>
  </tr>
  
  <tr>
    <td >Image Categories List</td>
  </tr>
  <?php
     $category_query = mysql_query("SELECT * FROM image_category") or die(mysql_error());
	 $category_num = mysql_num_rows($category_query);
	 if($category_num)
	 {
		 while($category_row=mysql_fetch_array($category_query))
		 {
	?>
			<tr>
    		<td class="recentevent"><a href="../admin/image_library.php?cat_id=<?php echo $category_row[image_category_id];?>" class="newstitle"><?php echo $category_row[image_category_name];?></a></td>
  			</tr>					 
  <?php
		 }
	 }
  ?>
  
  <tr>
    <td class="recentevent"><a href="../admin/video_category.php" class="newstitle">Video Categories</a></td>
  </tr>
  
  <tr>
    <td class="recentevent"><a href="../admin/video_category_add.php" class="newstitle">Add Video Category</a></td>
  </tr>
  
  <tr>
    <td >Video Categories List</td>
  </tr>
  <?php
     $category_query = mysql_query("SELECT * FROM video_category") or die(mysql_error());
	 $category_num = mysql_num_rows($category_query);
	 if($category_num)
	 {
		 while($category_row=mysql_fetch_array($category_query))
		 {
	?>
			<tr>
    		<td class="recentevent"><a href="../admin/video_library.php?cat_id=<?php echo $category_row[video_category_id];?>" class="newstitle"><?php echo $category_row[video_category_name];?></a></td>
  			</tr>					 
  <?php
		 }
	 }
  ?>

</table>

