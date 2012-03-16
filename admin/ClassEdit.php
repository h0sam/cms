<?php
ob_clean();
ob_start();
session_start();
include_once("../includes/config.php");
include_once("../includes/session_check.php");

echo $_SESSION["name"];
echo $_SESSION["pass"];
if (isset($_GET["cid"])){
	$class_id=VerifyInt($_GET["cid"]);
}

//$classes_query=mysql_query("SELECT * FROM classes WHERE cid=$class_id")or die("Classes Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
//$classes=mysql_fetch_array($classes_query);

$classes_result = $db->select("classes", "cid=$class_id");
foreach ($classes_result as $row){
	$class_name = $row["name"];
	$days = $row["days"];
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
	<link rel="stylesheet" href="css/style.css">
	
	<!-- include the skins (change to dark if you like) -->
	<link rel="stylesheet" href="css/light/theme.css" id="themestyle">
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
	<script src="js/functions.js"></script>
		
	<!-- all Third Party Plugins -->
	<script src="js/plugins.js"></script>
	<script src="js/editor.js"></script>
	<script src="js/calendar.js"></script>
	<script src="js/flot.js"></script>
	<script src="js/elfinder.js"></script>
	<script src="js/datatables.js"></script>
	
	<!-- all Whitelabel Plugins -->
	<script src="js/wl_Alert.js"></script>
	<script src="js/wl_Autocomplete.js"></script>
	<script src="js/wl_Breadcrumb.js"></script>
	<script src="js/wl_Calendar.js"></script>
	<script src="js/wl_Chart.js"></script>
	<script src="js/wl_Color.js"></script>
	<script src="js/wl_Date.js"></script>
	<script src="js/wl_Editor.js"></script>
	<script src="js/wl_File.js"></script>
	<script src="js/wl_Dialog.js"></script>
	<script src="js/wl_Fileexplorer.js"></script>
	<script src="js/wl_Form.js"></script>
	<script src="js/wl_Gallery.js"></script>
	<script src="js/wl_Multiselect.js"></script>
	<script src="js/wl_Number.js"></script>
	<script src="js/wl_Password.js"></script>
	<script src="js/wl_Slider.js"></script>
	<script src="js/wl_Store.js"></script>
	<script src="js/wl_Time.js"></script>
	<script src="js/wl_Valid.js"></script>
	<script src="js/wl_Widget.js"></script>
	
	<!-- configuration to overwrite settings -->
	<script src="js/config.js"></script>
		
	<!-- the script which handles all the access to plugins etc... -->
	<script src="js/script.js"></script>
	
	
</head>
<body>
				<div id="pageoptions">
			<?php include "../includes/page_options.php"; ?>
		</div>

			<header>
		<div id="logo">
			<a href="test.html">Logo Here</a>
		</div>
		<div id="header">
			<!-- header nav-->
            <?php include "../includes/header_nav.php"; ?>
		</div>
	</header>

				<!--<nav>
			
		</nav>-->
		<?php include "../includes/left_nav.php"; ?>
		
			
		<section id="content">
			
			<div class="g12">
			<h1>Forms <span><a href="doc-form.html" class="small">Documentation</a></span></h1>
			<a class="btn small fr" id="formsubmitswitcher">send form natively</a>
			<a class="btn small fr" id="formfiller" href="#">Fill this form with some data</a>
			<p>Full featured forms handle all of your data<br>
			Looks good with tableless, schematic markup.</p>
			

				<form id="class_edit" action="submit.php?page=classes&action=edit&cid=<?php echo $class_id; ?>" method="post" autocomplete="off">
                
                <fieldset>
						<label>Required Fields</label>
                        
						<section><label for="class_name">Class Name</label>
							<div><input type="text" id="class_name" name="class_name" required data-errortext="Class name is mandatory!" value="<?php echo $class_name; ?>">
							
							</div>
						</section>
                        
                        
                        
						 
                        
                        <section><label for="days_num">Days</label>
							<div><input id="days_num" name="days_num" type="number" class="integer" required="required" value="<?php echo $days; ?>">
							<br><span>This must be a number</span>
							</div>
						</section>
                        
                        
                        
                        
                        <section>
							<div><button class="reset">Reset</button><button class="submit">Submit</button></div>
						</section>
                        </fieldset>
                    
					
					
				</form>	
				</div>
		</section><!-- end div #content -->
		<footer><?php include "../includes/copyright.php"; ?></footer>
</body>
</html>
<?php
ob_end_flush();
?>