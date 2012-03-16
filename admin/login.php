<?php
ob_clean();
ob_start();
session_start();
include_once("../includes/config.php");

if (isset($_GET["action"])){
	$action=VerifyInput($_GET['action']);
	if ($action == "out"){
		session_unset();
		session_destroy();
		$_SESSION = array();
	}
}
if (isset($_SESSION["name"]) && isset($_SESSION["pass"])){
	header("location:users.php");
}




// one time check to create user #1
//$first_user_query=mysql_query("SELECT * FROM users")or die("First User Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
$first_user_result = $db->select("users", "*");

//$num_users=mysql_num_rows($first_user_result);
if (!$first_user_result){
	$pass=Encrypt("admin");
//mysql_query("INSERT INTO users (name,pass,email,created,access,login,status) VALUES ('admin','".Encrypt('admin')."','h0sam@hotmail.com','".time()."','".time()."','".time()."','1')")or die("First User Insert Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");	
$insert = array(
	"name" => "admin",
	"pass" => "$pass",
	"email" => "h0sam@hotmail.com"
	);
	$db->insert("users", $insert);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	
	<title>White Label | Login</title>
	
	<meta name="description" content="">
	<meta name="author" content="revaxarts.com">
	
	
	<!-- Apple iOS and Android stuff -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<link rel="apple-touch-icon-precomposed" href="img/icon.png">
	<link rel="apple-touch-startup-image" href="img/startup.png">
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no,maximum-scale=1">
	
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
	
	<!-- Use Google CDN for jQuery and jQuery UI -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
	
	<!-- Loading JS Files this way is not recommended! Merge them but keep their order -->
	
	<!-- some basic functions -->
	<script src="js/functions.js"></script>
		
	<!-- all Third Party Plugins -->
	<script src="js/plugins.js"></script>
		
	<!-- Whitelabel Plugins -->
	<script src="js/wl_Alert.js"></script>
	<script src="js/wl_Dialog.js"></script>
	<script src="js/wl_Form.js"></script>
		
	<!-- configuration to overwrite settings -->
	<script src="js/config.js"></script>
		
	<!-- the script which handles all the access to plugins etc... -->
	<!--<script src="js/login.js"></script>-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body id="login">
		<header>
			<div id="logo">
				<a href="login.html">whitelabel</a>
			</div>
		</header>
		<section id="content"><?php
									if (isset($_GET['x']))
									{
										echo("<font color='#ff0000'><b>Invalid User Name or Password</b></font><br><br>");
									}
								?>
		<form action="submit.php?page=login" id="loginform" method="post">
			<fieldset>
				<section><label for="username">Username</label>
					<div><input type="text" id="username" name="username" autofocus></div>
				</section>
				<section><label for="password">Password <a href="#">lost password?</a></label>
					<div><input type="password" id="password" name="password"></div>
					<div><input type="checkbox" id="remember" name="remember"><label for="remember" class="checkbox">remember me</label></div>
				</section>
				<section>
					<div><button class="fr submit">Login</button></div>
				</section>
			</fieldset>
		</form>
		</section>
		<footer><?php include "../includes/copyright.php"; ?></footer>
		
</body>
</html>
<?php
ob_end_flush();
?>