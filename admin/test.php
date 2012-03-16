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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
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
							<div><input id="email" name="email" type="email"  data-errortext="Email is mandatory"></div>
						</section>
						
                        <section><label for="password">Password<br><span>with confirmation</span></label>
							<div><input type="password" id="password" name="password" ></div>
						</section>
                        
                        <label>Other Basic Fields</label>
                        
						<section>
							<label>Role</label>
							<div>
                            <?php $roles_query=mysql_query("
							SELECT * FROM role ORDER BY rid ASC
							")or die("User Query: ".mysql_errno($db) . ": " . mysql_error($db) . "\n");
							while ($roles=mysql_fetch_array($roles_query)){
								$role_id=$roles["rid"];
								$role_name=$roles["name"];
							
							?>
								<input type="checkbox" name="user_roles[]" id="user_roles[]" value="<?php echo $role_id; ?>" >
                                <label for="user_role"><?php echo Output($role_name); ?></label>
								
                                <?php } ?>
							</div>
						</section>
                        
                        
						<section>
							<label>Status</label>
							<div>
								<input type="radio" id="user_status" name="user_status" value="1" checked="checked"><label for="active">Active</label>
								<input type="radio" id="user_status" name="user_status" value="0" ><label for="blocked">Blocked</label>
							</div>
						</section>
                        
                        
						<section>
							<div><button class="reset">Reset</button><button class="submit">Submit</button></div>
						</section>
					</fieldset>
                    
                    
					
					
				</form>
<body>
</body>
</html>