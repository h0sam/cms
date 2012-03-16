<?php
ob_clean();
ob_start();
session_start();
include_once("../includes/config.php");
include_once("../includes/session_check.php");

echo $_SESSION["name"];
echo $_SESSION["pass"];

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
			<a class="btn small fr" id="formfiller" href="form.html">Fill this form with some data</a>
			<p>Full featured forms handle all of your data<br>
			Looks good with tableless, schematic markup.</p>
			

				<form id="user_add" action="submit.php?page=users&action=new" method="post" >
                
                <fieldset>
						<label>Required Fields</label>
                        
						<!--<section><label for="required_field">Required Text Field</label>
							<div><input type="text" id="required_field" name="required_field" required></div>
						</section>-->
                        
						<section><label for="user_name">User Name</label>
							<div><input type="text" id="user_name" name="user_name" required data-errortext="Username is mandatory!">
							<!--<br><span>use <code>data-errortext="This is an custom error text!"</code> for custom message</span>-->
							</div>
						</section>
                        
                        
                        
						 <section><label for="email">Email</label>
							<div><input id="email" name="email" type="email"  data-errortext="Email is mandatory" required="required"></div>
						</section>
						
                        <section><label for="password">Password<br><span>with confirmation</span></label>
							<div><input type="password" id="password" name="password" required="required" ></div>
						</section>
                        
                        <label>Other Basic Fields</label>
                        
						<section>
							<label>Role</label>
							<div>
                            <?php //$roles_query=mysql_query("SELECT * FROM role ORDER BY rid ASC")or die("User Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
								//while ($roles=mysql_fetch_array($roles_query)){
								$roles_result = $db->select("role ORDER BY rid ASC");
								foreach ($roles_result as $row){
									$role_id=$row["rid"];
									$role_name=$row["name"];
							
							?>
								<input type="checkbox" name="user_roles[]" id="user_roles[]" value="<?php echo $role_id; ?>" <?php if ($role_name == "authenticated user"): ?> checked="checked" disabled="disabled" <?php endif; ?> >
                                <label for="user_role"><?php echo $role_name; ?></label>
								
                                <?php } ?>
							</div>
						</section>
                        
                        
                        
                        <section>
							<label>Class</label>
							<div>
                            <?php 
							//$class_query=mysql_query("SELECT * FROM classes")or die("Classes Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
							//while ($classes=mysql_fetch_array($class_query)){
							$class_result = $db->select("classes");
							foreach ($class_result as $row){
								$class_id=$row["cid"];
								$class_name=$row["name"];
							?>
								<input type="radio" id="user_class" name="user_class" value="<?php echo $class_id; ?>" <?php if ($row["days"] == "21" ): ?>checked="checked" <?php endif; ?>><label for="<?php echo $class_name; ?>"><?php echo $class_name; ?></label>
							
                            <?php
							}
							?>
							</div>
						</section>
                        
                        
                        
						<section>
							<label>Status</label>
							<div>
								<input type="radio" id="user_status" name="user_status" value="1" checked="checked"><label for="active">Active</label>
								<input type="radio" id="user_status" name="user_status" value="0" ><label for="blocked">Blocked</label>
							</div>
						</section>
                        
                        
						
					</fieldset>
                    
                    <label>Profile Fields</label>
					<fieldset>
                    <section><label for="first_name">First Name</label>
							<div><input type="text" id="first_name" name="first_name" >
							
							</div>
                            <label for="last_name">Last Name</label>
							<div><input type="text" id="last_name" name="last_name" >
							
							</div>
						</section>
                        
                        
                        <section><label for="textarea">Address</label>
							<div><textarea id="address" name="address" rows="10"></textarea></div>
						</section>
                        
                        
                        <section><label for="phone_1">Phone #1</label>
							<div><input id="phone_1" name="phone_1" type="number" class="integer" required="required">
							<br><span>This must be a phone number</span>
							</div>
						</section>
                        
                        <section><label for="integer">Phone #2</label>
							<div><input id="phone_2" name="phone_2" type="number" class="integer">
							<br><span>This must be a phone number</span>
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