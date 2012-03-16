<?php
session_start();
include_once("../includes/config.php");
if (isset($_GET["page"])){
	$page=VerifyInput($_GET["page"]);
}
if (isset($_GET["action"])){
	$action=VerifyInput($_GET["action"]);
}
$uid = $_SESSION["uid"];

$time_now=time();


	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
		//AJAX Request
		echo print_r($_POST, true);


switch ($page)
{
	case "login":
	//code for login form
	$name=VerifyInput($_POST["username"]);
	$pass=Encrypt($_POST["password"]);
	
	//$user_login_query=mysql_query("SELECT * FROM users WHERE name ='$name' AND pass='$pass' ")or die("User Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
	$login_result = $db->select("users", "name='$name' AND pass='$pass'", "*");
	$num_of_users=mysql_num_rows($login_result);	
   if($num_of_users == 0)
	{
		header("LOCATION:login.php?x=1");
		exit();
	}
	else if ($num_of_users == 1)
	{
		$_SESSION["name"] = $name;
		$_SESSION["pass"] = $pass;
		header("location:users.php");
		exit();
	}
	
	break;
	/////////////////////////
	///////login end
	////////////////////////
	////////////////////////
	
	//case for users actions: new users and editing users
	case "users":
	//code
	if (isset($_POST["user_name"])){
		$user_name=VerifyInput($_POST["user_name"]);
	}
	if (isset($_POST["email"])){
		$email=VerifyInput($_POST["email"]);
	}
	if (isset($_POST["user_status"])){
		$user_status=VerifyInt($_POST["user_status"]);
	}
	else{
		$user_status="0";
	}
	if (isset($_POST["user_class"])){
		$class_id=VerifyInt($_POST["user_class"]);
	}
	if (isset($_POST["password"])){
		$user_password=VerifyInput($_POST["password"]);
		$user_pass=Encrypt($user_password);
	}
	
	if (isset($_POST["first_name"])){
		$first_name=$_POST["first_name"];
	}
	if (isset($_POST["last_name"])){
		$last_name=$_POST["last_name"];
	}
	if (isset($_POST["address"])){
		$address=$_POST["address"];
	}
	if (isset($_POST["phone_1"])){
		$phone_1=$_POST["phone_1"];
	}
	if (isset($_POST["phone_2"])){
		$phone_2=$_POST["phone_2"];
	}
	
	
	if ($action == "new"){
		
		$user_check = $db->select("users", "name='$user_name OR email='$email'","name, email");
		
		if ($user_check){
			$err_message="This username or email has been used already!";
			echo $err_message;
		}
		else if (!$user_check){
			
			
			
			//
			$insert = array(
				"name" => "$user_name",
				"email" => "$email",
				"pass" => "$user_pass",
				"status" => "$user_status",
				"created" => "$time_now"
				);
				$insert_user = $db->insert("users", $insert);
				$last_user_result = $db->select("users", "", "max(uid)");
				foreach ($last_user_result as $row){
					$last_user_id = $row["uid"];
				}
				

			echo  ("<font color=\"red\">last user is: $last_user_id</font>");
			//insert data into users_roles table
			if (isset($_POST["user_roles"])){
						
				foreach ($_POST["user_roles"] as $key=>&$value)
				{
					
					$insert = array(
						"rid" => "$value",
						"uid" => "$last_user_id"
					);
					$db->insert("users_roles", $insert);
				}
			}
			//insert data into profile table
			
			
			$insert = array(
				"uid" => "$last_user_id",
				"first_name" => "$first_name",
				"last_name" => "$last_name",
				"address" => "$address",
				"phone_1" => "$phone_1",
				"phone_2" => "$phone_2"
				);
				$db->insert("users_profiles", $insert);
			
			//user class code
			//mysql_query("INSERT INTO users_classes (cid,uid) VALUES ('$class_id','$last_user_id')",$db)or die("Class Insert Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
			$insert = array(
						"cid" => "$class_id",
						"uid" => "$last_user_id"
					);
			$db->insert("users_classes", $insert);
		}
		echo "<div class=\"alert success\">User Added Successfully!</div>";
	}
	
	
	// this applies when editing users.
	if ($action == "edit"){
		if (isset($_GET["uid"])){
			$user_id=VerifyInt($_GET["uid"]);
		}
		//mysql_query("UPDATE users SET name='$user_name', email='$email', status='$user_status' WHERE uid=$user_id")or die("User Edit Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		
		$update = array(
		"name" => "$user_name",
		"email" => "$email",
		"status" => "$user_status"
		);
		$db->update("users", $update, "uid=$user_id");
		
		//mysql_query("UPDATE users_profiles SET first_name='$first_name', last_name='$last_name', address='$address', phone_1='$phone_1', phone_2='$phone_2' WHERE uid=$user_id")or die("User Edit profile Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		
		$update = array(
		"first_name" => "$first_name",
		"last_name" => "$last_name",
		"address" => "$address",
		"phone_1" => "$phone_1",
		"phone_2" => "$phone_2"
		);
		$db->update("users_profiles", $update, "uid=$user_id");
		
		//mysql_query("DELETE FROM users_classes WHERE uid=$user_id")or die("User classes delete Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		//mysql_query("INSERT INTO users_classes (cid,uid) VALUES ('$class_id','$user_id')")or die("User CLASSES Edit Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		// new delete query
		$db->delete("users_classes", "uid=$user_id");
		$insert = array(
		"cid" => "$class_id",
		"uid" => "$user_id"
		);
		$db->insert("users_classes", $insert);
		
		echo "<div class=\"alert success\">User Edited Successfully!</div>";
	}
	
	
	
	break;
	///////////////////////////////////////
	///////////////end users case
	////////////////////////////////////////
	
	//classes part starts here
	case "classes":
	
	if (isset($_POST["class_name"])){
		$class_name=VerifyInput($_POST["class_name"]);
	}
	if (isset($_POST["days_num"])){
		$days_num=VerifyInt($_POST["days_num"]);
	}
	if (isset($_GET["cid"])){
		$class_id=VerifyInt($_GET["cid"]);
	}
	
	if ($action == "new"){
		//code for adding classes
		//mysql_query("INSERT INTO classes (name,days) VALUES ('$class_name','$days_num')")or die("class insert Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		//
		$insert = array(
		"name" => "$class_name",
		"days" => "$days_num"
		);
		$db->insert("classes", $insert);
		
		echo "<div class=\"alert success\">Class Entered Successfully!</div>";
	}
	
	if ($action == "edit"){
		//code for editing classes goes here
		//mysql_query("UPDATE classes SET name='$class_name', days='$days_num' WHERE cid='$class_id'")or die("Class Edit Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		//
		$update = array(
		"name" => "$class_name",
		"days" => "$days_num"
		);
		$db->update("classes", $update, "cid=$class_id");
		echo "<div class=\"alert success\">Class Edited Successfully!</div>";
	}
	
	break;
	////////////////////////////////////
	/////////////end users classes
	////////////////////////////////////
	
	case "lclasses":
	//code for leave classes goes here!
	if (isset($_POST["leave_class_name"])){
		$leave_class_name=VerifyInput($_POST["leave_class_name"]);
	}
	if (isset($_POST["days_count"])){
		$days_count=VerifyInt($_POST["days_count"]);
	}
	if (isset($_GET["lcid"])){
		$leave_class_id=VerifyInt($_GET["lcid"]);
	}
	
	if ($action == "new"){
		//code for adding classes
		//mysql_query("INSERT INTO leave_classes (name,days_count) VALUES ('$leave_class_name','$days_count')")or die("leave class insert Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		$insert = array(
		"name" => "$leave_class_name",
		"days_count" => "$days_count"
		);
		$db->insert("leave_classes", $insert);
		
		echo "<div class=\"alert success\">Leave Class Entered Successfully!</div>";
		
	}
	
	if ($action == "edit"){
		//code for editing classes goes here
		//mysql_query("UPDATE leave_classes SET name='$leave_class_name', days_count='$days_count' WHERE lcid='$leave_class_id'")or die("Leave Class Edit Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		
		$update = array(
		"name" => "$leave_class_name",
		"days_count" => "$days_count"
		);
		$db->update("leave_classes", $update, "lcid=$leave_class_id");
		echo "<div class=\"alert success\">Leave Class Edited Successfully!</div>";
	}
	
	break;
	////////////////////////////////////////
	///////////////end leave classes
	////////////////////////////////////////
	
	case "leaves":
	
	
	//code for leaves goes here!
	if (isset($_POST["description"])){
		$description=$_POST["description"];
	}
	if (isset($_POST["start_date"])){
		$start_date=$_POST["start_date"];
	}
	if (isset($_POST["duration"])){
		$duration=$_POST["duration"];
	}
	if (isset($_POST["leave_class"])){
		$leave_class_id = $_POST["leave_class"];
	}
	if (isset($_GET["lid"])){
		$leave_id = $_GET["lid"];
	}
	
	if ($action == "new"){
		//code for adding classes
		$insert = array(
		"description" => "$description",
		"class_id" => "$leave_class_id",
		"created" => "$time_now",
		"start_date" => "$start_date",
		"duration" => "$duration"
		);
		$db->insert("leaves", $insert);
		
		$max_leave = $db->select("leaves", "", "max(lid)");
		foreach ($max_leave as $row){
			$last_leave_id = $row["lid"];
		}
		
		$insert = array(
			"lid" => "$last_leave_id",
			"uid" => "$uid"
		);
		
		$db->insert("users_leaves", $insert);
		
		echo "<div class=\"alert success\">Leave leased Successfully!</div>";
		
	}
	
	if ($action == "edit"){
		//code for editing classes goes here
		
		$update = array(
		"description" => "$description",
		"start_date" => "$start_date",
		"duration" => "$duration"
		);
		$db->update("leaves", $update, "lid=$leave_id");
		
		echo "<div class=\"alert success\">Leave Edited Successfully!</div>";
		
	}
	
	if ($action == "delete"){
		$db->delete("leaves","lid=$leave_id");
	}
	
	break;
	/////////////////////////////////////
	///////////end leaves//////////////
	//////////////////////////////////
	
	default:
	//code	
	
	//header("location:$page.php");
	//exit();
	
}
	}else{
		//Native Form Submit
		//echo '<br><textarea style="width:100%;height:90%">'.print_r($_POST, true).'</textarea>';
		?>
        <textarea style="width:100%;height:90%">
        <?php
		
switch ($page)
{
	case "login":
	//code for login form
	$name=VerifyInput($_POST["username"]);
	$pass=Encrypt($_POST["password"]);
	
	//$user_login_query=mysql_query("SELECT * FROM users WHERE name ='$name' AND pass='$pass' ")or die("User Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
	//$num_of_users=mysql_num_rows($user_login_query);
	$user_login_result = $db->select("users", "name='$name' AND pass='$pass'");	
   if(!$user_login_result)
	{
		header("LOCATION:login.php?x=1");
		exit();
	}
	else if ($user_login_result)
	{
		foreach ($user_login_result as $row){
			$uid = $row["uid"];
			$_SESSION["uid"] = $uid;
			$_SESSION["name"] = $name;
			$_SESSION["pass"] = $pass;
			echo "hello";
			header("location:users.php");
			exit();
		}
	}
	
	break;
	
	case "users":
	//code
	if (isset($_POST["user_name"])){
		$user_name=VerifyInput($_POST["user_name"]);
	}
	if (isset($_POST["email"])){
		$email=$_POST["email"];
	}
	if (isset($_POST["user_status"])){
		$user_status=$_POST["user_status"];
	}
	else{
		$user_status="0";
	}
	if (isset($_POST["password"])){
		$user_password=VerifyInput($_POST["password"]);
		$user_pass=Encrypt($user_password);
	}
	
	if (isset($_GET["uid"])){
		$user_id=$_GET["uid"];
	}
	
	
	
	if ($action == "new"){
		//insert data into users table
		mysql_query("INSERT INTO users (name,email,pass,status) VALUES ('$user_name','$email','$user_pass','$user_status')")or die("User Insert Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		$last_user_id=mysql_insert_id();
		
		if (isset($_POST["user_roles"])){
						
			foreach ($_POST["user_roles"] as $key=>&$value)
			{
				//echo "$last_user_id => $value&nbsp;&nbsp;";
				mysql_query("INSERT INTO users_roles (rid,uid) VALUES ('$value','$last_user_id') ")or die("User Roles Insert Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
			}
		}
		
		//die();
		  
		header("location:users.php");
		exit();
	}
	if ($action == "edit"){
		
		//mysql_query("UPDATE users SET name='$user_name', email='$email', status='$user_status' WHERE uid=$user_id")or die("User Edit Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		//header("location:users.php");
		$update = array(
		"name" => "$user_name",
		"email" => "$email",
		"status" => "$user_status"
		);
		$db->update("users", $update, "uid=$user_id");
	}
	
	//this is not an ajax request so it will be in the normal submit sections
	if ($action == "delete"){
		//delete from users table
		//mysql_query("DELETE FROM users WHERE uid='$user_id'")or die("User Delete Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		$db->delete("users", "uid=$user_id");
		//delete from users profiles table
		//mysql_query("DELETE FROM users_profiles WHERE uid='$user_id'")or die("User Profile Delete Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		$db->delete("users_profiles", "uid=$user_id");
		//delete from users_roles table
		//mysql_query("DELETE FROM users_roles WHERE uid='$user_id'")or die("User Roles Delete Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		$db->delete("users_roles", "uid=$user_id");
		//delete from users_classes table
		//mysql_query("DELETE FROM users_classes WHERE uid='$user_id'")or die("User Class Delete Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		$db->delete("users_classes", "uid=$user_id");
		header("location:users.php");
		
		exit();
	}
	
	break;
	
	
	case "classes":
	
	if (isset($_POST["class_name"])){
		$class_name=VerifyInput($_POST["class_name"]);
	}
	if (isset($_POST["days_num"])){
		$days_num=VerifyInt($_POST["days_num"]);
	}
	if (isset($_GET["cid"])){
		$class_id=VerifyInt($_GET["cid"]);
	}
	
	if ($action == "new"){
		//code for adding classes
		mysql_query("INSERT INTO classes (name,days) VALUES ('$class_name','$days_num')")or die("class insert Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		
	}
	
	if ($action == "edit"){
		//code for editing classes goes here
		mysql_query("UPDATE classes SET name='$class_name', days='$days_num' WHERE cid='$class_id'")or die("Class Edit Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		
	}
	
	if ($action == "delete"){
		//delete from classes table
		mysql_query("DELETE FROM classes WHERE cid='$class_id'")or die("Class delete Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		//delete from users_classes table
		mysql_query("DELETE FROM users_classes WHERE cid='$class_id'")or die("User Class delete Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		//go back to classes pages
		header("location:classes.php");
		exit();
	}
	
	break;
	
	case "lclasses":
	//code for leave classes goes here!
	if (isset($_POST["leave_class_name"])){
		$leave_class_name=VerifyInput($_POST["leave_class_name"]);
		
	}
	if (isset($_POST["days_count"])){
		$days_count=VerifyInt($_POST["days_count"]);
	}
	if (isset($_GET["lcid"])){
		$leave_class_id=VerifyInt($_GET["lcid"]);
	}
	
	if ($action == "new"){
		//code for adding classes
		mysql_query("INSERT INTO leave_classes (name,days_count) VALUES ('$leave_class_name','$days_count')")or die("leave class insert Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		
	}
	
	if ($action == "edit"){
		//code for editing classes goes here
		mysql_query("UPDATE leave_classes SET name='$leave_class_name', days_count='$days_count' WHERE lcid='$leave_class_id'")or die("Leave Class Edit Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
		
	}
	
	break;
	
	/////////////////////////////////////
	////////////end lclasses///////////
	////////////////////////////////////
	
	case "leaves":
	
	
	//code for leaves goes here!
	if (isset($_POST["description"])){
		$description=$_POST["description"];
	}
	if (isset($_POST["start_date"])){
		$start_date=$_POST["start_date"];
	}
	if (isset($_POST["duration"])){
		$duration=$_POST["duration"];
	}
	if (isset($_POST["leave_class"])){
		$leave_class = $_POST["leave_class"];
	}
	if (isset($_GET["lid"])){
		$leave_id = $_GET["lid"];
	}
	
	if ($action == "new"){
		//code for adding classes
		$insert = array(
		"description" => "$description",
		"class" => "$leave_class",
		"created" => "$time_now",
		"start_date" => "$start_date",
		"duration" => "$duration"
		);
		$db->insert("leaves", $insert);
		
		$max_leave = $db->select("leaves", "", "max(lid)");
		foreach ($max_leave as $row){
			$last_leave_id = $row["lid"];
		}
		
		$insert = array(
			"lid" => "$last_leave_id",
			"uid" => "$uid"
		);
		
		$db->insert("users_leaves", $insert);
		
		echo "<div class=\"alert success\">Leave leased Successfully!</div>";
		
	}
	
	if ($action == "edit"){
		//code for editing classes goes here
		
		
		$update = array(
		"name" => "$leave_class_name",
		"days_count" => "$days_count"
		);
		$db->update("leave_classes", $update, "lcid=$leave_class_id");
		echo "<div class=\"alert success\">Leave Class Edited Successfully!</div>";
	}
	
	if ($action == "delete"){
		$db->delete("leaves","lid=$leave_id");
		$db->delete("users_leaves","lid=$leave_id");
		header("location:../leaves.php");
	}
	
	break;
	////////////////////////////////
	///////end leaves
	/////////////////////////////////
	
	default:
	//code	
	
	//header("location:$page.php");
	//exit();
	
}
	
	?>
    
    </textarea>
    <?php } ?>

<?php 
/*$name=VerifyInput($_POST["username"]);
$pass=Encrypt($_POST["password"]);
$rs=mysql_query("SELECT * FROM users WHERE name ='$name' AND pass='$pass' ")or die("User Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");	
   if(!(mysql_num_rows($rs)))
	{
		header("LOCATION:login.php?x=1");
		exit();
	}
	else
	{
		$_SESSION["name"] = $name;
		$_SESSION["pass"] = $pass;
	}
	header("location:dashboard.php");
	exit();*/
	

?>
