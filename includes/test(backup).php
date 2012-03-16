<ul>
<?php
$q=$_GET["q"];
include_once("config.php");
$category_query = mysql_query("SELECT * FROM image_category  WHERE parent_id='".$q."' ORDER BY image_category_id DESC")or die(mysql_error());

$category_num= mysql_num_rows($category_query);
	if($category_num)
	{
		while($category_row=mysql_fetch_array($category_query))
		{
?>
        
        <li><a title="<?php echo $category_row['image_category_name']?>" href="#" onClick="return sR('image_library.php?action=get_images&category_id=<?php echo $category_row['image_category_id']?>&parent_id=<?php echo $category_row['parent_id']?>&category_name=<?php echo Encrypt($category_row['image_category_name'])?>', '', '','images') ;"> <?php echo $category_row['image_category_name']?></a></li>
<?php
		}
	}

?> 
</ul>