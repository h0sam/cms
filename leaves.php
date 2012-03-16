<?php
ob_clean();
ob_start();
session_start();
include_once("includes/init.php");
include_once("includes/session_check.php");

echo $_SESSION["name"];
echo $_SESSION["pass"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	
	<title>Leaves</title>
	
	<meta name="description" content="">
	<meta name="author" content="revaxarts.com">
	
	
	<!-- Google Font and style definitions -->
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=PT+Sans:regular,bold">
	<link rel="stylesheet" href="admin/css/style.css">
    <link rel="stylesheet" href="admin/css/light/buttons.css" />
	
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
			<h1>Leaves</h1>
			<?php $tr_grade="A";
			$td_class="c"; ?>
			<table class="datatable">
				<thead>
					<tr>
						<th width="14%">Description</th><th width="15%">Start Date</th><th width="15%">Duration</th><th width="27%">Created</th><th width="11%">Status</th>
						<th width="18%">Actions</th>
					</tr>
				</thead>
				<tbody>
                <?php
				
				
				$user_leaves_result = $db->select("users_leaves", "uid=$uid");
				foreach ($user_leaves_result as $user_leaves_row){
					
					$leave_id=$user_leaves_row["lid"];
					
					
					$leaves_result = $db->select("leaves", "lid=$leave_id");
					foreach ($leaves_result as $row){
						$leave_desc=$row["description"];
						$leave_start_date = $row["start_date"];
						$leave_created = $row["created"];
						$leave_created = date('Y-m-d H:i', $leave_created);
						$leave_approved = $row["approved"];
						$leave_duration = $row["duration"];
					}
					
				?>
					<tr class="grade<?php echo $tr_grade; ?>">
						<td><?php echo $leave_desc; ?></td><td><?php echo $leave_start_date; ?></td><td><?php echo $leave_duration; ?>&nbsp;Days</td><td class="<?php echo $td_class; ?>"><?php echo $leave_created; ?></td><td class="<?php echo $td_class; ?>"><?php print $leave_approved; ?>&nbsp;</td>
						<td class="<?php echo $td_class; ?>"><span class="button-group">
                            <a class="button icon edit" href="LeaveEdit.php?lid=<?php echo $leave_id; ?>&action=edit">Edit</a>
                            <a class="button icon remove danger" href="admin/submit.php?page=leaves&action=delete&lid=<?php echo $leave_id; ?>">Remove</a>
                          </span>&nbsp;</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

			
		</section><!-- end div #content -->
		<footer><?php include "includes/copyright.php"; ?></footer>
</body>
</html>