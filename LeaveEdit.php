<?php
ob_clean();
ob_start();
session_start();
include_once("includes/init.php");
include_once("includes/session_check.php");

echo $_SESSION["name"];
echo $_SESSION["pass"];
echo $_SESSION["uid"];
if (isset($_GET["lid"])){
	$leave_id=$_GET["lid"];
	//$user_id=1;
}

$leave_result = $db->select("leaves", "lid=$leave_id");
foreach ($leave_result as $row){
	$leave_description=$row["description"];
	$start_date=$row["start_date"];
	$approved=$row["approved"];
	$duration = $row["duration"];
	$class_id = $row["class_id"];
	$class_result = $db->select("leave_classes","lcid=$class_id");
	foreach ($class_result as $row){
		$class = $row["name"];
	}
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	
	<title>White Label - a full featured Admin Skin</title>
	
	<meta name="description" content="">
	<meta name="author" content="revaxarts.com">
	
	
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="admin/css/style.css">
	
	<!-- include the skins (change to dark if you like) -->
	<link rel="stylesheet" href="admin/css/light/theme.css" id="themestyle">
	<!-- <link rel="stylesheet" href="css/dark/theme.css" id="themestyle"> -->
	
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<link rel="stylesheet" href="css/ie.css">
	<![endif]-->
	
	<!-- Apple iOS and Android stuff -->
	<meta name="apple-mobile-web-app-capable" content="no">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
	
	<!-- Apple iOS and Android stuff - don't remove! -->
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">
	
	<!-- Use Google CDN for jQuery and jQuery UI -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
	
	<!-- Loading JS Files this way is not recommended! Merge them but keep their order -->
	
	<!-- some basic functions -->
	<script src="admin/js/functions.js"></script>
		
	<!-- all Third Party Plugins -->
	<script src="admin/js/plugins.js"></script>
	<script src="admin/js/editor.js"></script>
	<script src="admin/js/calendar.js"></script>
	<script src="admin/js/flot.js"></script>
	<script src="admin/js/elfinder.js"></script>
	<script src="admin/js/datatables.js"></script>
	
	<!-- all Whitelabel Plugins -->
	<script src="admin/js/wl_Alert.js"></script>
	<script src="admin/js/wl_Autocomplete.js"></script>
	<script src="admin/js/wl_Breadcrumb.js"></script>
	<script src="admin/js/wl_Calendar.js"></script>
	<script src="admin/js/wl_Chart.js"></script>
	<script src="admin/js/wl_Color.js"></script>
	<script src="admin/js/wl_Date.js"></script>
	<script src="admin/js/wl_Editor.js"></script>
	<script src="admin/js/wl_File.js"></script>
	<script src="admin/js/wl_Dialog.js"></script>
	<script src="admin/js/wl_Fileexplorer.js"></script>
	<script src="admin/js/wl_Form.js"></script>
	<script src="admin/js/wl_Gallery.js"></script>
	<script src="admin/js/wl_Multiselect.js"></script>
	<script src="admin/js/wl_Number.js"></script>
	<script src="admin/js/wl_Password.js"></script>
	<script src="admin/js/wl_Slider.js"></script>
	<script src="admin/js/wl_Store.js"></script>
	<script src="admin/js/wl_Time.js"></script>
	<script src="admin/js/wl_Valid.js"></script>
	<script src="admin/js/wl_Widget.js"></script>
	
	<!-- configuration to overwrite settings -->
	<script src="admin/js/config.js"></script>
		
	<!-- the script which handles all the access to plugins etc... -->
	<script src="admin/js/script.js"></script>
	
	
</head>
<body>
				<div id="pageoptions">
			<?php include "includes/page_options.php"; ?>
		</div>

			<header>
		<div id="logo">
			<a href="test.html">Logo Here</a>
		</div>
		<div id="header">
			<!-- header nav-->
            <?php include "includes/header_nav.php"; ?>
		</div>
	</header>

				<!--<nav>
			
		</nav>-->
		<?php include "includes/left_nav.php"; ?>
		
			
		<section id="content">
			
			<div class="g12">
			<h1>Forms <span><a href="doc-form.html" class="small">Documentation</a></span></h1>
			<a class="btn small fr" id="formsubmitswitcher">send form natively</a>
			<a class="btn small fr" id="formfiller" href="#">Fill this form with some data</a>
			<p>Full featured forms handle all of your data<br>
			Looks good with tableless, schematic markup.</p>
			

				<form id="edit_leave" action="admin/submit.php?page=leaves&action=edit&lid=<?php print $leave_id; ?>" method="post" >
                
                <fieldset>
						<label>Required Fields</label>
                        
						<section><label for="description">description</label>
							<div><textarea id="description" name="description" rows="10"><?php print $leave_description; ?></textarea></div>
						</section>
                        
                        
                        <section>
							<label>Class</label>
							<div>
                            <?php 
							
							$leave_classes_result = $db->select("leave_classes ORDER BY lcid ASC");
								foreach ($leave_classes_result as $row){
									$class_id=$row["lcid"];
									$class_name=$row["name"];
									
									
									
							?>
								<input type="radio" id="leave_class" name="leave_class" value="<?php echo $class_id; ?>" <?php if ($class_name == $class ): ?>checked="checked" <?php endif; ?>><label for="<?php echo $class_name; ?>"><?php echo $class_name; ?></label>
							
                            <?php
							}
							?>
							</div>
						</section>
                        
                        
						<section><label for="start_date">Start Date</label>
							<div><input id="start_date" name="start_date" type="text" class="date" required="required" value="<?php print $start_date; ?>">
							<!--<br><span>You can define displayed format within the settings. yyyy-mm-dd will always be used on submit</span>-->
							</div>
						</section>
                        
                        
                       <section><label for="duration">Duration</label>
							<div><input id="duration" name="duration" type="number" class="integer" required="required" value="<?php print $duration; ?>">
							<br><span>How many days?</span>
							</div>
						</section>
                        
                        
                        <?php
						echo "<br>".$class_name."<br>";
									echo $class;
									?>
                        
                        
						<section>
							<label>Approved</label>
							<div>
								<input type="radio" id="approved" name="approved" value="1" disabled="disabled"><label for="approved">Approved</label>
								<input type="radio" id="approved" name="approved" value="0" checked="checked" ><label for="blocked">Not Approved</label>
							</div>
						</section>
                        
                        
                        
                        
                        
                        <section>
							<div><button class="reset">Reset</button><button class="submit">Submit</button></div>
						</section>
						
					</fieldset>
                    
                    
                        
                        
                        
					
				</form>	
				</div>
		</section><!-- end div #content -->
		<footer><?php include "includes/copyright.php"; ?></footer>
</body>
</html>
<?php
ob_end_flush();
?>